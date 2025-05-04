<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Modules\Sale\Entities\Sale;
use Illuminate\Support\Facades\DB;
use Modules\People\Entities\Customer;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\ProductStock\Entities\ProductStock;


class Checkout extends Component
{

    public $listeners = ['productSelected', 'discountModalRefresh'];

    public $cart_instance;
    public $customers;
    public $global_discount;
    public $global_tax;
    public $shipping;
    public $quantity;
    public $check_quantity;
    public $discount_type;
    public $item_discount;
    public $data;
    public $customer_id;
    public $total_amount;

    public $show_checkout_form = false;
    public $payment_method = 'Cash';
    public $notes;

    public  $tax_percentage = 0;
    public $discount_percentage = 0;
    public $shipping_amount = 0;
    public $paid_amount = 0;
    public $note = '';

    public function checkout()
    {
        // Validasi
        $this->validate([
            'payment_method' => 'required|string',
        ]);

        // Simpan transaksi atau logika lainnya di sini...

        // Reset cart dan form
        $this->resetCart();
        $this->reset(['show_checkout_form', 'payment_method', 'notes']);

        session()->flash('message', 'Transaksi berhasil disimpan!');
    }



    public function submitCheckout()
    {
        $branch_id = session('selected_branch');
        $sale = null;

        try {
            DB::transaction(function () use ($branch_id, &$sale) {
                $due_amount = $this->total_amount - $this->paid_amount;

                if ($due_amount == $this->total_amount) {
                    $payment_status = 'Unpaid';
                } elseif ($due_amount > 0) {
                    $payment_status = 'Partial';
                } else {
                    $payment_status = 'Paid';
                }

                // Cek stok
                foreach (Cart::instance('sale')->content() as $cart_item) {
                    $stock = ProductStock::where([
                        'product_id' => $cart_item->id,
                        'branch_id' => $branch_id
                    ])->first();

                    if (!$stock || $stock->quantity < $cart_item->qty) {
                        throw new \Exception('Stok tidak mencukupi untuk produk: ' . $cart_item->name);
                    }
                }

                // Simpan Sale
                $sale = Sale::create([
                    'date' => now()->format('Y-m-d'),
                    'reference' => 'PSL',
                    'customer_id' => $this->customer_id,
                    'customer_name' => Customer::findOrFail($this->customer_id)->customer_name,
                    'tax_percentage' => $this->tax_percentage,
                    'discount_percentage' => $this->discount_percentage,
                    'shipping_amount' => (int) $this->shipping_amount * 100,
                    'paid_amount' => (int) $this->paid_amount * 100,
                    'total_amount' => (int) $this->total_amount * 100,
                    'due_amount' => (int) $due_amount * 100,
                    'status' => 'Completed',
                    'payment_status' => $payment_status,
                    'payment_method' => $this->payment_method,
                    'note' => $this->note,
                    'tax_amount' => Cart::instance('sale')->tax(),
                    'discount_amount' => Cart::instance('sale')->discount(),
                    'branch_id' => $branch_id
                ]);

                // Simpan detail produk
                foreach (Cart::instance('sale')->content() as $cart_item) {
                    SaleDetails::create([
                        'sale_id' => $sale->id,
                        'product_id' => $cart_item->id,
                        'product_name' => $cart_item->name,
                        'product_code' => $cart_item->options->code,
                        'quantity' => $cart_item->qty,
                        'price' => $cart_item->price,
                        'unit_price' => $cart_item->options->unit_price,
                        'sub_total' => $cart_item->options->sub_total,
                        'product_discount_amount' => $cart_item->options->product_discount,
                        'product_discount_type' => $cart_item->options->product_discount_type,
                        'product_tax_amount' => $cart_item->options->product_tax,
                    ]);

                    $stock = ProductStock::where([
                        'product_id' => $cart_item->id,
                        'branch_id' => $branch_id
                    ])->first();

                    $stock->decrement('quantity', $cart_item->qty);
                }

                Cart::instance('sale')->destroy();

                // Simpan pembayaran
                if ($sale->paid_amount > 0) {
                    SalePayment::create([
                        'date' => now()->format('Y-m-d'),
                        'reference' => 'INV/' . $sale->reference,
                        'amount' => $sale->paid_amount,
                        'sale_id' => $sale->id,
                        'payment_method' => $this->payment_method,
                        'branch_id' => $branch_id
                    ]);
                }
            });

            // if ($sale) {
            //     $customer = Customer::find($sale->customer_id);

            //     $message = "Terima kasih telah berbelanja di toko kami!\n"
            //         . "No. Invoice: " . $sale->reference . "\n"
            //         . "Tanggal: " . now()->format('Y-m-d') . "\n"
            //         . "Total Bayar: " . format_currency($sale->total_amount) . "\n"
            //         . "Metode Bayar: " . $sale->payment_method . "\n"
            //         . "Status: " . $sale->payment_status . "\n"
            //         . "Terimakasih " . $customer->customer_name . "!\n\n"
            //         . "Website Kami : https://www.reang.net";

            //     app('App\Services\WhatsappService')->sendMessage($customer->customer_phone, $message);
            // }

            session()->flash('checkout_message', 'Checkout berhasil!');

            if ($sale) {
                return redirect()->back()->with([
                    'print_sale_id' => $sale->id,
                    'success' => 'POS Sale Created!'
                ]);
            }
            // Reset input jika perlu
            $this->reset([
                'customer_id',
                'tax_percentage',
                'discount_percentage',
                'shipping_amount',
                'paid_amount',
                'total_amount',
                'payment_method',
                'note'
            ]);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'stok tidak mencukupi')) {
                $this->addError('stock', 'Stok tidak mencukupi!');
                return;
            }

            throw $e;
        }
    }


    public function mount($cartInstance, $customers)
    {
        $this->cart_instance = $cartInstance;
        $this->customers = $customers;
        $this->global_discount = 0;
        $this->global_tax = 0;
        $this->shipping = 0.00;
        $this->check_quantity = [];
        $this->quantity = [];
        $this->discount_type = [];
        $this->item_discount = [];
        $this->total_amount = 0;
        $this->total_amount = $this->calculateTotal(); // Initialize with correct total
    }

    public function hydrate()
    {
        $this->total_amount = $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $cart_total = Cart::instance($this->cart_instance)->total();
        // Remove any currency symbols and thousand separators
        $clean_total = preg_replace('/[^\d.-]/', '', $cart_total);
        return (float) $clean_total + $this->shipping;
    }

    // tanpa desimal
    // public function calculateTotal()
    // {
    //     // subtotal() return string float, tapi harga kita integer (tanpa desimal)
    //     $cart_total = (float) Cart::instance($this->cart_instance)->subtotal(0, '', ''); // tanpa desimal
    //     return (int) $cart_total + (int) $this->shipping;
    // }



    public function formatNumber($number)
    {
        // Ensure the number is treated as float
        return number_format((float) $number, 2, '.', '');
    }

    public function proceed()
    {
        if ($this->customer_id != null) {
            // Update total_amount before showing modal
            $this->total_amount = $this->calculateTotal();
            $this->dispatch('showCheckoutModal');
        } else {
            session()->flash('message', 'Please Select Customer!');
        }
    }


    // public function calculateTotal() {
    //     $cart_total = Cart::instance($this->cart_instance)->total();
    //     $total = is_string($cart_total) ? floatval(str_replace(',', '', $cart_total)) : $cart_total;
    //     return $total + $this->shipping;
    // }

    // public function calculateTotal()
    // {
    //     $cart_total = (float) Cart::instance($this->cart_instance)->subtotal(2, '.', '');
    //     return $cart_total + (float) $this->shipping;
    // }



    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        // Always ensure total_amount is updated before rendering
        $this->total_amount = $this->calculateTotal();

        return view('livewire.pos.checkout', [
            'cart_items' => $cart_items
        ]);
    }

    // Add a method to handle cart updates
    public function updated($name, $value)
    {
        if (in_array($name, ['global_tax', 'global_discount', 'shipping'])) {
            $this->total_amount = $this->calculateTotal();
        }
    }
    public function resetCart()
    {
        Cart::instance($this->cart_instance)->destroy();
    }

    // public function productSelected($product)
    // {
    //     $cart = Cart::instance($this->cart_instance);

    //     $exists = $cart->search(function ($cartItem, $rowId) use ($product) {
    //         return $cartItem->id == $product['id'];
    //     });

    //     if ($exists->isNotEmpty()) {
    //         session()->flash('message', 'Product exists in the cart!');
    //         return;
    //     }

    //     // Cek stock di ProductStock
    //     $branch_id = session('selected_branch');
    //     $stock = ProductStock::where([
    //         'product_id' => $product['id'],
    //         'branch_id' => $branch_id
    //     ])->first();

    //     $available_stock = $stock ? $stock->quantity : 0;

    //     if ($available_stock <= 0) {
    //         session()->flash('message', 'Product is out of stock!');
    //         return;
    //     }

    //     $cart->add([
    //         'id'      => $product['id'],
    //         'name'    => $product['product_name'],
    //         'qty'     => 1,
    //         'price'   => $this->calculate($product)['price'],
    //         'weight'  => 1,
    //         'options' => [
    //             'product_discount'      => 0.00,
    //             'product_discount_type' => 'fixed',
    //             'sub_total'             => $this->calculate($product)['sub_total'],
    //             'code'                  => $product['product_code'],
    //             'stock'                 => $available_stock, // Gunakan stock dari ProductStock
    //             'unit'                  => $product['product_unit'],
    //             'product_tax'           => $this->calculate($product)['product_tax'],
    //             'unit_price'            => $this->calculate($product)['unit_price']
    //         ]
    //     ]);

    //     $this->check_quantity[$product['id']] = $available_stock; // Gunakan stock dari ProductStock
    //     $this->quantity[$product['id']] = 1;
    //     $this->discount_type[$product['id']] = 'fixed';
    //     $this->item_discount[$product['id']] = 0;
    //     $this->total_amount = $this->calculateTotal();
    // }

    public function productSelected($product)
    {
        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id == $product['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');
            return;
        }

        $branch_id = session('selected_branch');
        $stock = ProductStock::where([
            'product_id' => $product['id'],
            'branch_id' => $branch_id
        ])->first();

        if (!$stock || $stock->quantity <= 0) {
            session()->flash('message', 'Product is out of stock!');
            return;
        }

        $available_stock = $stock->quantity;
        $calculated = $this->calculate($product);

        $cart->add([
            'id'      => $product['id'],
            'name'    => $product['product_name'],
            'qty'     => 1,
            'price'   => $calculated['price'],
            'weight'  => 1,
            'options' => [
                'product_discount'      => 0.00,
                'product_discount_type' => 'fixed',
                'sub_total'             => $calculated['sub_total'],
                'code'                  => $product['product_code'],
                'stock'                 => $available_stock,
                'unit'                  => $product['product_unit'],
                'product_tax'           => $calculated['product_tax'],
                'unit_price'            => $calculated['unit_price']
            ]
        ]);

        $this->check_quantity[$product['id']] = $available_stock;
        $this->quantity[$product['id']] = 1;
        $this->discount_type[$product['id']] = 'fixed';
        $this->item_discount[$product['id']] = 0;
        $this->total_amount = $this->calculateTotal();
    }



    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function updatedGlobalTax()
    {
        Cart::instance($this->cart_instance)->setGlobalTax((int)$this->global_tax);
    }

    public function updatedGlobalDiscount()
    {
        Cart::instance($this->cart_instance)->setGlobalDiscount((int)$this->global_discount);
    }

    public function updateQuantity($row_id, $product_id)
    {
        // Cek stock di ProductStock
        $branch_id = session('selected_branch');
        $stock = ProductStock::where([
            'product_id' => $product_id,
            'branch_id' => $branch_id
        ])->first();

        $available_stock = $stock ? $stock->quantity : 0;

        if ($available_stock < $this->quantity[$product_id]) {
            session()->flash('message', 'The requested quantity is not available in stock.');
            return;
        }

        Cart::instance($this->cart_instance)->update($row_id, $this->quantity[$product_id]);

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'sub_total'             => $cart_item->price * $cart_item->qty,
                'code'                  => $cart_item->options->code,
                'stock'                 => $available_stock, // Update stock dari ProductStock
                'unit'                  => $cart_item->options->unit,
                'product_tax'           => $cart_item->options->product_tax,
                'unit_price'            => $cart_item->options->unit_price,
                'product_discount'      => $cart_item->options->product_discount,
                'product_discount_type' => $cart_item->options->product_discount_type,
            ]
        ]);
    }


    public function updatedDiscountType($value, $name)
    {
        $this->item_discount[$name] = 0;
    }

    public function discountModalRefresh($product_id, $row_id)
    {
        $this->updateQuantity($row_id, $product_id);
    }

    public function setProductDiscount($row_id, $product_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        if ($this->discount_type[$product_id] == 'fixed') {
            Cart::instance($this->cart_instance)
                ->update($row_id, [
                    'price' => ($cart_item->price + $cart_item->options->product_discount) - $this->item_discount[$product_id]
                ]);

            $discount_amount = $this->item_discount[$product_id];

            $this->updateCartOptions($row_id, $product_id, $cart_item, $discount_amount);
        } elseif ($this->discount_type[$product_id] == 'percentage') {
            $discount_amount = ($cart_item->price + $cart_item->options->product_discount) * ($this->item_discount[$product_id] / 100);

            Cart::instance($this->cart_instance)
                ->update($row_id, [
                    'price' => ($cart_item->price + $cart_item->options->product_discount) - $discount_amount
                ]);

            $this->updateCartOptions($row_id, $product_id, $cart_item, $discount_amount);
        }

        session()->flash('discount_message' . $product_id, 'Discount added to the product!');
    }

    public function calculate($product)
    {
        $price = 0;
        $unit_price = 0;
        $product_tax = 0;
        $sub_total = 0;

        if ($product['product_tax_type'] == 1) {
            $price = $product['product_price'] + ($product['product_price'] * ($product['product_order_tax'] / 100));
            $unit_price = $product['product_price'];
            $product_tax = $product['product_price'] * ($product['product_order_tax'] / 100);
            $sub_total = $product['product_price'] + ($product['product_price'] * ($product['product_order_tax'] / 100));
        } elseif ($product['product_tax_type'] == 2) {
            $price = $product['product_price'];
            $unit_price = $product['product_price'] - ($product['product_price'] * ($product['product_order_tax'] / 100));
            $product_tax = $product['product_price'] * ($product['product_order_tax'] / 100);
            $sub_total = $product['product_price'];
        } else {
            $price = $product['product_price'];
            $unit_price = $product['product_price'];
            $product_tax = 0.00;
            $sub_total = $product['product_price'];
        }

        return ['price' => $price, 'unit_price' => $unit_price, 'product_tax' => $product_tax, 'sub_total' => $sub_total];
    }

    public function updateCartOptions($row_id, $product_id, $cart_item, $discount_amount)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'sub_total'             => $cart_item->price * $cart_item->qty,
            'code'                  => $cart_item->options->code,
            'stock'                 => $cart_item->options->stock,
            'unit'                 => $cart_item->options->unit,
            'product_tax'           => $cart_item->options->product_tax,
            'unit_price'            => $cart_item->options->unit_price,
            'product_discount'      => $discount_amount,
            'product_discount_type' => $this->discount_type[$product_id],
        ]]);
    }
}
