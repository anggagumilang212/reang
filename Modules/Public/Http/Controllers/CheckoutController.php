<?php

namespace Modules\Public\Http\Controllers;

use Carbon\Carbon;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Branch\Entities\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Modules\Product\Entities\Product;
use Modules\Public\Entities\FlashSale;
use Modules\Public\Entities\Transaction;
use Illuminate\Contracts\Support\Renderable;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public::index');
    }

    public function checkout(Product $product)
    {
        $flashSale = FlashSale::where('product_id', $product->id)
            ->where('status', 'active')
            ->where('start_time', '<=', Carbon::now()->addDay())
            ->where('end_time', '>=', Carbon::now())
            ->first();

        if ($flashSale) {
            // Format waktu ke ISO 8601 untuk JavaScript
            $flashSale = $flashSale->toArray();
            $flashSale['start_time'] = Carbon::parse($flashSale['start_time'])->format('c');
            $flashSale['end_time'] = Carbon::parse($flashSale['end_time'])->format('c');
        }
        $branch = Branch::get();
        return view('public::checkout', compact('product', 'branch', 'flashSale'));
    }
    public function __construct()
    {
        // Set your Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function snaptoken(Request $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);

            // Check for flash sale
            $flashSale = FlashSale::where('product_id', $product->id)
                ->where('status', 'active')
                ->where('start_time', '<=', Carbon::now()->addDay())
                ->where('end_time', '>=', Carbon::now())
                ->first();

            // If there's an active flash sale, use the flash sale price
            $productPrice = $flashSale ? $flashSale->flash_sale_price : $product->product_price;

            // Buat payload untuk Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id' => 'TRX-' . time(),
                    'gross_amount' => (int) $productPrice, // Use flash sale price if available
                ],
                'customer_details' => [
                    'first_name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                ],
                'item_details' => [
                    [
                        'id' => $product->id,
                        'price' => (int) $productPrice, // Use flash sale price if available
                        'quantity' => 1,
                        'name' => $product->product_name,
                    ]
                ],
            ];

            // Get Snap Token
            $snapToken = Snap::getSnapToken($payload);

            return response()->json([
                'status' => 'success',
                'snapToken' => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // function tanpa send wa
    // public function process(Request $request)
    // {
    //     \Log::info('Request data:', $request->all());

    //     try {
    //         // Validate request
    //         $validated = $request->validate([
    //             'customer_name' => 'required|string|max:255',
    //             'customer_phone' => 'required|string|max:20',
    //             'branch_id' => 'required|exists:branch,id',
    //             'payment_method' => 'required|in:transfer,cash',
    //             'product_id' => 'required|exists:products,id'
    //         ]);

    //         // Get product details
    //         $product = Product::findOrFail($request->product_id);

    //         // Create transaction with paid status
    //         $transaction = Transaction::create([
    //             'transaction_code' => 'TRX-' . time(),
    //             'user_id' => auth()->check() ? auth()->id() : null,
    //             'product_id' => $product->id,
    //             'branch_id' => $request->branch_id,
    //             'amount' => $product->product_price,
    //             'payment_method' => $request->payment_method,
    //             'customer_name' => $request->customer_name,
    //             'customer_phone' => $request->customer_phone,
    //             'payment_status' => 'paid', // Langsung set paid
    //             'paid_at' => now() // Set waktu pembayaran
    //         ]);

    //         if ($request->payment_method === 'transfer') {
    //             // Set up Midtrans payment
    //             $payload = [
    //                 'transaction_details' => [
    //                     'order_id' => $transaction->transaction_code,
    //                     'gross_amount' => (int) $transaction->amount,
    //                 ],
    //                 'customer_details' => [
    //                     'first_name' => $transaction->customer_name,
    //                     'phone' => $transaction->customer_phone,
    //                 ],
    //                 'item_details' => [
    //                     [
    //                         'id' => $product->id,
    //                         'price' => (int) $product->product_price,
    //                         'quantity' => 1,
    //                         'name' => $product->product_name,
    //                     ]
    //                 ],
    //             ];

    //             try {
    //                 // Get Snap Payment Page URL
    //                 $snapToken = Snap::getSnapToken($payload);
    //                 $transaction->update(['snap_token' => $snapToken]);

    //                 // Return JSON response for Midtrans popup
    //                 // return response()->json([
    //                 //     'status' => 'success',
    //                 //     'snap_token' => $snapToken,
    //                 //     'redirect_url' => route('payment.success', ['transaction' => $transaction->transaction_code])
    //                 // ]);
    //                 return redirect()->route('payment.success', ['transaction' => $transaction->transaction_code]);
    //             } catch (\Exception $e) {
    //                 \Log::error('Midtrans Error: ' . $e->getMessage());

    //                 return response()->json([
    //                     'status' => 'error',
    //                     'message' => 'Payment gateway error'
    //                 ], 500);
    //             }
    //         } else {
    //             // Untuk pembayaran cash, langsung redirect ke halaman sukses
    //             return redirect()->route('payment.success', ['transaction' => $transaction->transaction_code]);
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error('Checkout Error: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'An error occurred during checkout'
    //         ], 500);
    //     }
    // }

    public function process(Request $request)
    {
        \Log::info('Request data:', $request->all());

        try {
            // Validate request
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_phone' => 'required|string|max:20',
                'branch_id' => 'required|exists:branch,id',
                'payment_method' => 'required|in:transfer,cash',
                'product_id' => 'required|exists:products,id'
            ]);

            // Get product details
            $product = Product::findOrFail($request->product_id);

            // Check if the product is part of a flash sale
            if ($product->flashSale && $product->flashSale->is_active) {
                $flashSale = $product->flashSale;

                // Check stock availability in flash sale
                if ($flashSale->stock < 1) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Flash sale stock is out'
                    ], 400);
                }

                // Apply flash sale discount
                $product->product_price = $flashSale->discounted_price;
            }

            // Begin transaction
            \DB::beginTransaction();

            // pengurangan stock saat flash sale
            FlashSale::where('product_id', $product->id)
                ->where('stock', '>', 0)
                ->decrement('stock', 1);

            // Get branch details to get the phone number
            $branch = Branch::findOrFail($request->branch_id);

            // Create transaction with paid status
            $transaction = Transaction::create([
                'transaction_code' => 'TRX-' . time(),
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id' => $product->id,
                'branch_id' => $request->branch_id,
                'amount' => $product->product_price,
                'payment_method' => $request->payment_method,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'payment_status' => 'paid',
                'paid_at' => now()
            ]);

            // Commit transaction
            \DB::commit();

            // Handle payment via transfer or cash
            if ($request->payment_method === 'transfer') {
                $payload = [
                    'transaction_details' => [
                        'order_id' => $transaction->transaction_code,
                        'gross_amount' => (int) $transaction->amount,
                    ],
                    'customer_details' => [
                        'first_name' => $transaction->customer_name,
                        'phone' => $transaction->customer_phone,
                    ],
                    'item_details' => [
                        [
                            'id' => $product->id,
                            'price' => (int) $product->product_price,
                            'quantity' => 1,
                            'name' => $product->product_name,
                        ]
                    ],
                ];

                try {
                    $snapToken = Snap::getSnapToken($payload);
                    $transaction->update(['snap_token' => $snapToken]);
                    return redirect()->route('payment.success', ['transaction' => $transaction->transaction_code, 'productId' => $product->id]);
                } catch (\Exception $e) {
                    \Log::error('Midtrans Error: ' . $e->getMessage());
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Payment gateway error'
                    ], 500);
                }
            } else {
                return redirect()->route('payment.success', ['transaction' => $transaction->transaction_code, 'productId' => $product->id]);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during checkout'
            ], 500);
        }
    }




    // Handle Midtrans notification
    public function handleNotification(Request $request)
    {
        try {
            $notification = new Notification();

            $transaction = Transaction::where('transaction_code', $notification->order_id)->firstOrFail();

            $transaction_status = $notification->transaction_status;
            $fraud = $notification->fraud_status;

            \Log::info('Payment notification received: ', [
                'order_id' => $notification->order_id,
                'status' => $transaction_status,
                'fraud' => $fraud
            ]);

            // Update transaction status berdasarkan notifikasi Midtrans
            if (
                $transaction_status == 'settlement' ||
                ($transaction_status == 'capture' && $fraud == 'accept')
            ) {
                // Tidak perlu update status karena sudah paid
                // Hanya update informasi tambahan jika diperlukan
                $transaction->midtrans_status = $transaction_status;
                $transaction->save();
            } else if (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
                // Handle pembatalan/kegagalan pembayaran
                $transaction->payment_status = 'failed';
                $transaction->save();

                // Kirim notifikasi ke user jika diperlukan
                // ...
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Notification handled'
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error processing notification'
            ], 500);
        }
    }



    // Add method to show success page
    public function showPaymentSuccess($transaction, $productId)
    {
        $product = Product::findOrFail($productId);

        $flashSale = FlashSale::where('product_id', $product->id)
            ->where('status', 'active')
            ->where('start_time', '<=', Carbon::now()->addDay())
            ->where('end_time', '>=', Carbon::now())
            ->first();

        if ($flashSale) {
            // Format waktu ke ISO 8601 untuk JavaScript
            $flashSale = $flashSale->toArray();
            $flashSale['start_time'] = Carbon::parse($flashSale['start_time'])->format('c');
            $flashSale['end_time'] = Carbon::parse($flashSale['end_time'])->format('c');
        }

        $transaction = Transaction::where('transaction_code', $transaction)
            ->where('payment_status', 'paid')
            ->with(['product', 'branch'])
            ->firstOrFail();

        return view('public::payment.success', compact('transaction', 'flashSale'));
    }


    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::where('transaction_code', $request->order_id)->first();

            if ($transaction) {
                $transaction->update([
                    'payment_status' => $request->transaction_status,
                    'midtrans_transaction_id' => $request->transaction_id,
                    'midtrans_payment_type' => $request->payment_type,
                ]);

                return response()->json(['status' => 'success']);
            }
        }

        return response()->json(['status' => 'error'], 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('public::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('public::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
