<?php

namespace Modules\Sale\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Sale\Entities\Sale;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Product;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Sale\DataTables\SalesDataTable;
use Modules\ProductStock\Entities\ProductStock;
use Modules\Sale\Http\Requests\StoreSaleRequest;
use Modules\Sale\Http\Requests\UpdateSaleRequest;

class WhatsAppService
{
    public function sendMessage($phone, $message)
    {
        try {
            $response = Http::post('http://localhost:8000/send-message', [
                'number' => $phone,
                'message' => $message
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            \Log::error('WhatsApp sending failed: ' . $e->getMessage());
            return false;
        }
    }
}
class SaleController extends Controller
{
    protected $whatsappService;
    public function __construct()
    {
        $this->whatsappService = new WhatsAppService();
    }

    public function index(SalesDataTable $dataTable)
    {
        abort_if(Gate::denies('access_sales'), 403);

        return $dataTable->render('sale::index');
    }


    public function create()
    {
        abort_if(Gate::denies('create_sales'), 403);

        Cart::instance('sale')->destroy();

        return view('sale::create');
    }


    public function store(StoreSaleRequest $request)
    {
        $sale = null;

        try {
            DB::transaction(function () use ($request, &$sale) {
                $due_amount = $request->total_amount - $request->paid_amount;

                if ($due_amount == $request->total_amount) {
                    $payment_status = 'Unpaid';
                } elseif ($due_amount > 0) {
                    $payment_status = 'Partial';
                } else {
                    $payment_status = 'Paid';
                }

                // Check stock availability before processing
                foreach (Cart::instance('sale')->content() as $cart_item) {
                    $stock = ProductStock::where([
                        'product_id' => $cart_item->id,
                        'branch_id' => $request->branch_id
                    ])->first();

                    if (!$stock || $stock->quantity < $cart_item->qty) {
                        throw new \Exception('Insufficient stock for product: ' . $cart_item->name);
                    }
                }

                $sale = Sale::create([
                    'date' => $request->date,
                    'reference' => 'SL', // You might want to generate a unique reference
                    'customer_id' => $request->customer_id,
                    'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                    'tax_percentage' => $request->tax_percentage,
                    'discount_percentage' => $request->discount_percentage,
                    'shipping_amount' => $request->shipping_amount * 100,
                    'paid_amount' => $request->paid_amount * 100,
                    'total_amount' => $request->total_amount * 100,
                    'due_amount' => $due_amount * 100,
                    'status' => $request->status,
                    'payment_status' => $payment_status,
                    'payment_method' => $request->payment_method,
                    'note' => $request->note,
                    'tax_amount' => Cart::instance('sale')->tax() * 100,
                    'discount_amount' => Cart::instance('sale')->discount() * 100,
                    'branch_id' => $request->branch_id
                ]);

                foreach (Cart::instance('sale')->content() as $cart_item) {
                    SaleDetails::create([
                        'sale_id' => $sale->id,
                        'product_id' => $cart_item->id,
                        'product_name' => $cart_item->name,
                        'product_code' => $cart_item->options->code,
                        'quantity' => $cart_item->qty,
                        'price' => $cart_item->price * 100,
                        'unit_price' => $cart_item->options->unit_price * 100,
                        'sub_total' => $cart_item->options->sub_total * 100,
                        'product_discount_amount' => $cart_item->options->product_discount * 100,
                        'product_discount_type' => $cart_item->options->product_discount_type,
                        'product_tax_amount' => $cart_item->options->product_tax * 100,
                    ]);

                    // Update stock quantity
                    $stock = ProductStock::where([
                        'product_id' => $cart_item->id,
                        'branch_id' => $request->branch_id
                    ])->first();

                    $stock->decrement('quantity', $cart_item->qty);
                }

                Cart::instance('sale')->destroy();

                if ($sale->paid_amount > 0) {
                    SalePayment::create([
                        'date' => $request->date,
                        'reference' => 'INV/' . $sale->reference,
                        'amount' => $sale->paid_amount,
                        'sale_id' => $sale->id,
                        'payment_method' => $request->payment_method,
                        'branch_id' => $request->branch_id
                    ]);
                }
            });

            // Send WhatsApp message after successful transaction
            if ($sale) {
                $customer = Customer::find($sale->customer_id);

                $message = "Terima kasih telah berbelanja di toko kami!\n"
                    . "No. Invoice: " . $sale->reference . "\n"
                    . "Tanggal: " . $sale->date . "\n"
                    . "Total Bayar: " . format_currency($sale->total_amount) . "\n"
                    . "Metode Bayar: " . $sale->payment_method . "\n"
                    . "Status: " . $sale->payment_status . "\n"
                    . "Terimakasih " . $customer->customer_name . "!\n\n"
                    . "Website Kami : https://www.reang.net";

                $this->whatsappService->sendMessage($customer->customer_phone, $message);
            }

            toast('Sale Created!', 'success');
            return redirect()->route('sales.index');
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'Insufficient stock')) {
                toast('Maaf, stok produk tidak mencukupi!', 'error');
                return redirect()->back();
            }
            throw $e;
        }
    }

    public function show(Sale $sale)
    {
        // abort_if(Gate::denies('show_sales'), 403);

        $customer = Customer::findOrFail($sale->customer_id);

        return view('sale::show', compact('sale', 'customer'));
    }

    public function edit(Sale $sale)
    {
        abort_if(Gate::denies('edit_sales'), 403);

        $sale_details = $sale->saleDetails;

        Cart::instance('sale')->destroy();
        $cart = Cart::instance('sale');

        foreach ($sale_details as $sale_detail) {
            // Mengambil stock dari ProductStock
            $product_stock = ProductStock::where('product_id', $sale_detail->product_id)
                ->sum('quantity');

            $cart->add([
                'id'      => $sale_detail->product_id,
                'name'    => $sale_detail->product_name,
                'qty'     => $sale_detail->quantity,
                'price'   => $sale_detail->price,
                'weight'  => 1,
                'options' => [
                    'product_discount' => $sale_detail->product_discount_amount,
                    'product_discount_type' => $sale_detail->product_discount_type,
                    'sub_total'   => $sale_detail->sub_total,
                    'code'        => $sale_detail->product_code,
                    'stock'       => $product_stock, // Menggunakan stock dari ProductStock
                    'product_tax' => $sale_detail->product_tax_amount,
                    'unit_price'  => $sale_detail->unit_price
                ]
            ]);
        }

        return view('sale::edit', compact('sale'));
    }

    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        try {
            DB::transaction(function () use ($request, $sale) {
                $due_amount = $request->total_amount - $request->paid_amount;

                if ($due_amount == $request->total_amount) {
                    $payment_status = 'Unpaid';
                } elseif ($due_amount > 0) {
                    $payment_status = 'Partial';
                } else {
                    $payment_status = 'Paid';
                }

                // Return stock quantity for old sale details
                foreach ($sale->saleDetails as $sale_detail) {
                    $stock = ProductStock::where([
                        'product_id' => $sale_detail->product_id,
                        'branch_id' => $sale->branch_id
                    ])->first();

                    if ($stock) {
                        $stock->increment('quantity', $sale_detail->quantity);
                    }
                    $sale_detail->delete();
                }

                // Check stock availability for new items
                foreach (Cart::instance('sale')->content() as $cart_item) {
                    $stock = ProductStock::where([
                        'product_id' => $cart_item->id,
                        'branch_id' => $request->branch_id
                    ])->first();

                    if (!$stock || $stock->quantity < $cart_item->qty) {
                        throw new \Exception('Insufficient stock for product: ' . $cart_item->name);
                    }
                }

                $sale->update([
                    'date' => $request->date,
                    'customer_id' => $request->customer_id,
                    'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                    'tax_percentage' => $request->tax_percentage,
                    'discount_percentage' => $request->discount_percentage,
                    'shipping_amount' => $request->shipping_amount * 100,
                    'paid_amount' => $request->paid_amount * 100,
                    'total_amount' => $request->total_amount * 100,
                    'due_amount' => $due_amount * 100,
                    'status' => $request->status,
                    'payment_status' => $payment_status,
                    'payment_method' => $request->payment_method,
                    'note' => $request->note,
                    'tax_amount' => Cart::instance('sale')->tax() * 100,
                    'discount_amount' => Cart::instance('sale')->discount() * 100,
                    'branch_id' => $request->branch_id
                ]);

                // Create new sale details and update stock
                foreach (Cart::instance('sale')->content() as $cart_item) {
                    SaleDetails::create([
                        'sale_id' => $sale->id,
                        'product_id' => $cart_item->id,
                        'product_name' => $cart_item->name,
                        'product_code' => $cart_item->options->code,
                        'quantity' => $cart_item->qty,
                        'price' => $cart_item->price * 100,
                        'unit_price' => $cart_item->options->unit_price * 100,
                        'sub_total' => $cart_item->options->sub_total * 100,
                        'product_discount_amount' => $cart_item->options->product_discount * 100,
                        'product_discount_type' => $cart_item->options->product_discount_type,
                        'product_tax_amount' => $cart_item->options->product_tax * 100,
                    ]);

                    // Update stock quantity
                    $stock = ProductStock::where([
                        'product_id' => $cart_item->id,
                        'branch_id' => $request->branch_id
                    ])->first();

                    $stock->decrement('quantity', $cart_item->qty);
                }

                Cart::instance('sale')->destroy();

                // Update or create payment if necessary
                if ($sale->paid_amount > 0) {
                    SalePayment::updateOrCreate(
                        ['sale_id' => $sale->id],
                        [
                            'date' => $request->date,
                            'reference' => 'INV/' . $sale->reference,
                            'amount' => $sale->paid_amount,
                            'payment_method' => $request->payment_method,
                            'branch_id' => $request->branch_id
                        ]
                    );
                }
            });

            toast('Sale Updated!', 'info');
            return redirect()->route('sales.index');
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'Insufficient stock')) {
                toast('Maaf, stok produk tidak mencukupi!', 'error');
                return redirect()->back();
            }
            throw $e;
        }
    }

    public function destroy(Sale $sale)
    {
        abort_if(Gate::denies('delete_sales'), 403);

        $sale->delete();

        toast('Sale Deleted!', 'warning');

        return redirect()->route('sales.index');
    }

    public function printreport(Request $request)
    {
        $query = Sale::with( 'branch')
            ->whereDate('date', '>=', $request->start_date)
            ->whereDate('date', '<=', $request->end_date)
            ->when($request->branch_id, function ($query) use ($request) {
                return $query->where('branch_id', $request->branch_id);
            })
            ->when($request->sale_status, function ($query) use ($request) {
                return $query->where('status', $request->sale_status);
            })
            ->when($request->payment_status, function ($query) use ($request) {
                return $query->where('payment_status', $request->payment_status);
            })
            ->orderBy('date', 'desc');

        $sales = $query->get();

        $totalSales = $sales->sum('total_amount');
        $totalProfit = $sales->sum(function ($sale) {
            return $sale->saleDetails->sum(function ($detail) {
                return ($detail->price - $detail->product->cost) * $detail->quantity;
            });
        });

        return view('sale::sales-print', [
            'sales' => $sales,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'totalSales' => $totalSales,
            'totalProfit' => $totalProfit
        ]);
    }

}
