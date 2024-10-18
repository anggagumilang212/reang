<?php

namespace Modules\Sale\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Sale\Entities\Sale;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Support\Renderable;
use Modules\ProductStock\Entities\ProductStock;
use Modules\Sale\Http\Requests\StorePosSaleRequest;

class PosController extends Controller
{
    public function __construct()
    {
        // Tambahkan middleware untuk cek branch
        $this->middleware('check.branch');
    }

    public function index() {
        Cart::instance('sale')->destroy();

        $branch_id = session('selected_branch');

        $customers = Customer::all();
        $product_categories = Category::all();

        // Ambil produk beserta stok khusus untuk cabang yang dipilih
        $products = Product::with(['stocks' => function($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        }])->get();

        return view('sale::pos.index', compact('product_categories', 'customers', 'products'));
    }

    public function store(StorePosSaleRequest $request) {
        $branch_id = session('selected_branch');

        DB::transaction(function () use ($request, $branch_id) {
            $due_amount = $request->total_amount - $request->paid_amount;

            if ($due_amount == $request->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            $sale = Sale::create([
                'date' => now()->format('Y-m-d'),
                'reference' => 'PSL',
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => 'Completed',
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('sale')->tax() * 100,
                'discount_amount' => Cart::instance('sale')->discount() * 100,
                'branch_id' => $branch_id // Tambahkan branch_id
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

                // Update stok pada cabang yang bersangkutan
                $stock = ProductStock::where([
                    'product_id' => $cart_item->id,
                    'branch_id' => $branch_id
                ])->first();

                if ($stock) {
                    if ($stock->quantity < $cart_item->qty) {
                        throw new \Exception('Insufficient stock for product: ' . $cart_item->name);
                    }

                    $stock->decrement('quantity', $cart_item->qty);
                } else {
                    throw new \Exception('Product stock not found in this branch: ' . $cart_item->name);
                }
            }

            Cart::instance('sale')->destroy();

            if ($sale->paid_amount > 0) {
                SalePayment::create([
                    'date' => now()->format('Y-m-d'),
                    'reference' => 'INV/'.$sale->reference,
                    'amount' => $sale->paid_amount,
                    'sale_id' => $sale->id,
                    'payment_method' => $request->payment_method,
                    'branch_id' => $branch_id // Tambahkan branch_id
                ]);
            }
        });

        toast('POS Sale Created!', 'success');

        return redirect()->route('sales.index');
    }

    // Tambahkan method untuk menampilkan stok di cabang
    public function getProductStock($product_id)
    {
        $branch_id = session('selected_branch');

        $stock = ProductStock::where([
            'product_id' => $product_id,
            'branch_id' => $branch_id
        ])->first();

        return response()->json([
            'stock_quantity' => $stock ? $stock->quantity : 0
        ]);
    }
}
