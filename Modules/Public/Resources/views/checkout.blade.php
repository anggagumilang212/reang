<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-4">
        <!-- Breadcrumb -->
        <div class="text-sm mb-4">
            <span class="text-gray-500">Home</span>
            <span class="mx-2 text-gray-500">&gt;</span>
            <a href="{{ route('products.detail', $product->id) }}"
                class="text-gray-500">{{ $product->product_name }}</a>
            <span class="mx-2 text-gray-500">&gt;</span>
            <span class="text-gray-700">Checkout</span>
        </div>

        <h1 class="text-2xl font-bold mb-6">Checkout</h1>

        <!-- Main Content Container -->
        <div class="lg:flex lg:gap-6">
            <!-- Product Summary Card -->
            <div class="lg:w-80 mb-6 lg:mb-0">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <!-- Banner Image -->
                    <div class="w-full h-32 bg-gray-800 overflow-hidden">
                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Netflix Banner"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <!-- Product Logo and Rating -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center">
                                <img src="{{ asset('images/reangnet.png') }}" alt="">
                            </div>
                            <div>
                                <h2 class="font-semibold">{{ $product->product_name }}</h2>
                                <div class="flex items-center">
                                    {{-- <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="ml-1 text-sm text-gray-600">4.9</span> --}}
                                    <span class="ml-1 text-xs text-gray-400">Stock :
                                        {{ is_array($flashSale) ? $flashSale['stock'] : $flashSale->stock ?? ($product->productStock->quantity ?? '0') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Info -->
                        <div class="flex justify-between items-center mb-3">
                            @if ($flashSale && isset($flashSale['flash_sale_price'], $flashSale['normal_price']))
                                <span class="text-lg font-bold text-red-500">
                                    Rp {{ number_format($flashSale['flash_sale_price'], 0, ',', '.') }}
                                    <span class="text-sm font-bold line-through text-gray-500">
                                        Rp {{ number_format($flashSale['normal_price'], 0, ',', '.') }}
                                    @else
                                        <span class="text-lg font-bold">Rp
                                            {{ number_format($product->product_price, 0, ',', '.') }}</span>
                            @endif
                            <span
                                class="bg-pink-500 text-white px-2 py-1 rounded-full text-xs ">{{ $product->category->category_name }}</span>
                        </div>

                        <!-- Discount Badge -->
                        @if ($product->is_flash_sale)
                            <div class="flex items-center text-green-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Diskon Flash Sale: Hemat
                                    {{ number_format((($product->product_price - $product->flash_sale_price) / $product->product_price) * 100, 0) }}%</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="flex-1">
                <!-- Orange Header -->
                <div class="bg-gradient-to-r mb-2 from-orange-300 to-orange-500 text-white p-4 rounded-t-xl">
                    <p> Harap masukkan informasi pemesanan dengan benar.</p>
                </div>

                <div class="bg-white z-10 rounded-xl shadow-md overflow-hidden -mt-4">

                    <!-- Form Content -->
                    <div class="p-6">
                        <h3 class="font-semibold mb-4">Personal Informations</h3>

                        <form id="payment-form" method="POST" action="{{ route('api.checkout.process') }}">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" id="snap_token" name="snap_token">
                            <!-- Full Name -->
                            <div class="mb-4">
                                <label class="block text-gray-600 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="customer_name" placeholder="Masukkan Nama Lengkap"
                                        class="w-full pl-10 pr-4 py-2 bg-gray-50 rounded-lg border border-gray-200 focus:outline-none focus:border-orange-500">
                                </div>
                            </div>

                            <!-- WhatsApp Number -->
                            <div class="mb-4">
                                <label class="block text-gray-600 mb-2">Nomor WhatsApp</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </span>
                                    <input type="tel" name="customer_phone" placeholder="Masukkan Nomor WhatsApp"
                                        class="w-full pl-10 pr-4 py-2 bg-gray-50 rounded-lg border border-gray-200 focus:outline-none focus:border-orange-500">
                                </div>
                            </div>


                            <!-- Branch -->
                            <div class="mb-6">
                                <h3 class="font-semibold mb-4">Ambil Di Cabang Toko</h3>
                                <div class="space-y-3">
                                    @foreach ($branch as $item)
                                        @php
                                            // Mengambil stok produk di branch tersebut
                                            $stock = $item
                                                ->stocks()
                                                ->where('product_id', $product->id)
                                                ->first();
                                            $quantity = $stock ? $stock->quantity : 0;
                                        @endphp

                                        <label class="block">
                                            <div
                                                class="bg-white border rounded-lg p-4 {{ $quantity > 0 ? 'cursor-pointer hover:border-orange-500' : 'opacity-50' }} transition-colors [&:has(input:checked)]:border-orange-500 [&:has(input:checked)]:ring-2 [&:has(input:checked)]:ring-orange-200">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-3">
                                                        <input type="radio" name="branch_id"
                                                            value="{{ $item->id }}"
                                                            class="w-4 h-4 text-orange-600"
                                                            {{ $quantity <= 0 ? 'disabled' : '' }}>
                                                        <div class="flex items-center gap-3">
                                                            <div>
                                                                <p class="font-medium">{{ $item->name }}</p>
                                                                <p class="text-sm text-gray-500">{{ $item->address }}
                                                                </p>
                                                                @if ($quantity <= 0)
                                                                    <p class="text-sm text-red-500">stok kosong</p>
                                                                @else
                                                                    <p class="text-sm text-green-500">stok tersedia
                                                                        {{ is_array($flashSale) ? $flashSale['stock'] : $flashSale->stock ?? ($product->productStock->quantity ?? '0') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Payment Method -->
                            <div class="mb-12">
                                <h3 class="font-semibold mb-4">Pilih Metode Pembayaran</h3>
                                <div class="space-y-3">
                                    <!-- BCA Payment -->
                                    <label class="block">
                                        <div
                                            class="bg-white border rounded-lg p-4 cursor-pointer hover:border-orange-500 transition-colors [&:has(input:checked)]:border-orange-500 [&:has(input:checked)]:ring-2 [&:has(input:checked)]:ring-orange-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <input type="radio" name="payment_method" value="transfer"
                                                        class="w-4 h-4 text-orange-600">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-6 h-6 text-green-600" fill="currentColor"
                                                                viewBox="0 0 576 512">
                                                                <path
                                                                    d="M64 32C28.7 32 0 60.7 0 96l0 32 576 0 0-32c0-35.3-28.7-64-64-64L64 32zM576 224L0 224 0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-192zM112 352l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="font-medium">Transfer Bank</p>
                                                            <p class="text-sm text-gray-500">Virtual Account</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <svg class="w-5 h-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Cash Payment -->
                                    <label class="block">
                                        <div
                                            class="bg-white border rounded-lg p-4 cursor-pointer hover:border-orange-500 transition-colors [&:has(input:checked)]:border-orange-500 [&:has(input:checked)]:ring-2 [&:has(input:checked)]:ring-orange-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <input type="radio" name="payment_method" value="cash"
                                                        class="w-4 h-4 text-orange-500">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-6 h-6 text-green-600" fill="currentColor"
                                                                viewBox="0 0 576 512">
                                                                <path
                                                                    d="M312 24l0 10.5c6.4 1.2 12.6 2.7 18.2 4.2c12.8 3.4 20.4 16.6 17 29.4s-16.6 20.4-29.4 17c-10.9-2.9-21.1-4.9-30.2-5c-7.3-.1-14.7 1.7-19.4 4.4c-2.1 1.3-3.1 2.4-3.5 3c-.3 .5-.7 1.2-.7 2.8c0 .3 0 .5 0 .6c.2 .2 .9 1.2 3.3 2.6c5.8 3.5 14.4 6.2 27.4 10.1l.9 .3s0 0 0 0c11.1 3.3 25.9 7.8 37.9 15.3c13.7 8.6 26.1 22.9 26.4 44.9c.3 22.5-11.4 38.9-26.7 48.5c-6.7 4.1-13.9 7-21.3 8.8l0 10.6c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-11.4c-9.5-2.3-18.2-5.3-25.6-7.8c-2.1-.7-4.1-1.4-6-2c-12.6-4.2-19.4-17.8-15.2-30.4s17.8-19.4 30.4-15.2c2.6 .9 5 1.7 7.3 2.5c13.6 4.6 23.4 7.9 33.9 8.3c8 .3 15.1-1.6 19.2-4.1c1.9-1.2 2.8-2.2 3.2-2.9c.4-.6 .9-1.8 .8-4.1l0-.2c0-1 0-2.1-4-4.6c-5.7-3.6-14.3-6.4-27.1-10.3l-1.9-.6c-10.8-3.2-25-7.5-36.4-14.4c-13.5-8.1-26.5-22-26.6-44.1c-.1-22.9 12.9-38.6 27.7-47.4c6.4-3.8 13.3-6.4 20.2-8.2L264 24c0-13.3 10.7-24 24-24s24 10.7 24 24zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5L192 512 32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l36.8 0 44.9-36c22.7-18.2 50.9-28 80-28l78.3 0 16 0 64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l120.6 0 119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384c0 0 0 0 0 0l-.9 0c.3 0 .6 0 .9 0z" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="font-medium">Cash</p>
                                                            <p class="text-sm text-gray-500">Cash Payment</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <svg class="w-5 h-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>


                            <!-- Fixed Bottom Card -->
                            <div class="fixed bottom-0 rounded-xl left-0 right-0 bg-white shadow-lg border-t p-4">
                                <div class="max-w-6xl mx-auto flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="text-gray-600 text-sm">Total Price</span>

                                        @if ($flashSale && isset($flashSale['flash_sale_price'], $flashSale['normal_price']))
                                            <span class="text-xl font-bold text-pink-500">
                                                Rp {{ number_format($flashSale['flash_sale_price'], 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-lg font-bold">
                                                Rp {{ number_format($product->product_price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" id="pay-button"
                                        class="bg-gradient-to-r from-orange-300 to-orange-500  text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- js snap midtrans --}}

    <script>
        $(document).ready(function() {
            $('#pay-button').click(function(event) {
                event.preventDefault();

                var paymentMethod = $('input[name="payment_method"]:checked').val();
                var customerName = $('input[name="customer_name"]').val();
                var customerPhone = $('input[name="customer_phone"]').val();
                var branchId = $('input[name="branch_id"]:checked').val();

                // Validasi form
                if (!customerName || !customerPhone || !branchId || !paymentMethod) {
                    alert('Harap isi semua data yang diperlukan');
                    return;
                }

                if (paymentMethod === 'transfer') {
                    $.ajax({
                        url: "{{ route('api.checkout.snaptoken') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            product_id: $('input[name="product_id"]').val(),
                            customer_name: customerName,
                            customer_phone: customerPhone,
                            branch_id: branchId,
                            payment_method: paymentMethod
                        },
                        beforeSend: function() {
                            $('#pay-button').prop('disabled', true).text('Processing...');
                        },
                        success: function(response) {
                            if (response.snapToken) {
                                snap.pay(response.snapToken, {
                                    onSuccess: function(result) {
                                        console.log('success');
                                        console.log(result);
                                        // Submit form untuk proses selanjutnya
                                        $('#payment-form').submit();
                                    },
                                    onPending: function(result) {
                                        console.log('pending');
                                        console.log(result);
                                        $('#payment-form').submit();
                                    },
                                    onError: function(result) {
                                        console.log('error');
                                        console.log(result);
                                        alert('Pembayaran gagal! ' + result
                                            .status_message);
                                        $('#pay-button').prop('disabled', false)
                                            .text('Bayar Sekarang');
                                    },
                                    onClose: function() {
                                        $('#pay-button').prop('disabled', false)
                                            .text('Bayar Sekarang');
                                    }
                                });
                            }
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan! ' + xhr.responseJSON.message);
                            $('#pay-button').prop('disabled', false).text('Bayar Sekarang');
                        }
                    });
                } else {
                    // Langsung submit form untuk pembayaran cash
                    $('#payment-form').submit();
                }
            });
        });
    </script>
</body>

</html>
