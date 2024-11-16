<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<div class="bg-gray-100 pb-24 md:px-44">
    <div class="max-w-6xl mx-auto p-4">
        <!-- Breadcrumb -->
        <div class="text-sm mb-4">
            <a href="/"><span class="text-gray-500">Home</span></a>
            <span class="mx-2 text-gray-500">&gt;</span>
            <a href="/product"><span class="text-gray-700">Product</span></a>
        </div>
        <!-- Main Content Container -->
        <div class="lg:flex lg:gap-6">
            <!-- Product Details Card -->
            <div class="lg:flex-1">
                {{-- resources/views/products/show.blade.php --}}

                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4" x-data="flashSale(@js([
                    'currentStock' => $flashSale ? $flashSale['stock'] : $product->productStock->quantity ?? 0,
                    'startTime' => $flashSale ? $flashSale['start_time'] : null,
                    'endTime' => $flashSale ? $flashSale['end_time'] : null,
                    'normalPrice' => $product->product_price,
                    'flashPrice' => $flashSale ? $flashSale['flash_sale_price'] : $product->product_price,
                    'productId' => $product->id,
                ]))">
                    <!-- Banner Image -->
                    <div class="w-full h-48 bg-gray-800 overflow-hidden">
                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <!-- Product Logo and Rating -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-black rounded-lg flex items-center justify-center">
                                <img src="{{ asset('images/reangnet.png') }}" alt="">
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold">{{ $product->product_name }}
                                </h2>
                                <div class="flex items-center">
                                    <span class="ml-1 text-gray-400">Stock:
                                        <span>
                                            {{ is_array($flashSale) ? $flashSale['stock'] : $flashSale->stock ?? ($product->productStock->quantity ?? '0') }}
                                        </span>
                                    </span>

                                </div>
                            </div>
                        </div>

                    

                        <!-- Flash Sale Timer & Badge (if active) -->
                        @if ($flashSale)
                            <div class="mb-4">
                                <div class="bg-red-50 border border-red-100 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 2a.75.75 0 01.75.75v.25h1.5a.75.75 0 110 1.5h-1.5v.25a.75.75 0 11-1.5 0v-.25h-1.5a.75.75 0 010-1.5h1.5v-.25A.75.75 0 0110 2z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M3.5 6A1.5 1.5 0 002 7.5v5A1.5 1.5 0 003.5 14h13a1.5 1.5 0 001.5-1.5v-5A1.5 1.5 0 0016.5 6h-13zm13-1.5h-13A3 3 0 000 7.5v5A3 3 0 003.5 15h13a3 3 0 003-3v-5a3 3 0 00-3-3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span x-text="timerLabel" class="font-semibold text-red-600"></span>
                                        </div>
                                        <div class="text-red-600 font-mono">
                                            <span x-text="String(hours).padStart(2, '0')">00</span>:
                                            <span x-text="String(minutes).padStart(2, '0')">00</span>:
                                            <span x-text="String(seconds).padStart(2, '0')">00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Price Tag -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col">
                                    @if ($flashSale && isset($flashSale['flash_sale_price'], $flashSale['normal_price']))
                                        <div class="flex items-center gap-2">
                                            <span class="text-2xl font-bold text-red-500">
                                                Rp {{ number_format($flashSale['flash_sale_price'], 0, ',', '.') }}
                                            </span>
                                            <span class="text-sm text-gray-400 line-through">
                                                Rp {{ number_format($flashSale['normal_price'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-red-500" x-show="saleStatus === 'waiting'">
                                            Flash sale dimulai pukul
                                            {{ date('H:i', strtotime($flashSale['start_time'])) }}
                                            WIB
                                        </div>
                                    @else
                                        <span class="text-2xl font-bold">
                                            Rp {{ number_format($product->product_price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>

                                <span class="bg-pink-500 text-white px-3 py-1 rounded-full text-sm">
                                    {{ $product->category->category_name }}
                                </span>
                            </div>
                        </div>

                        <!-- Rest of your product details... -->

                        <!-- Fixed Bottom Card -->
                        <div class="fixed bottom-0 rounded-xl left-0 right-0 bg-white shadow-lg border-t p-4">
                            <div class="max-w-6xl mx-auto flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-gray-600 text-sm">Total Price</span>
                                    <span class="text-xl font-bold"
                                        :class="{ 'text-red-500': saleStatus === 'active' }">
                                        Rp <span x-text="formatPrice(getCurrentPrice())"></span>
                                    </span>
                                </div>
                                @if ($flashSale)
                                    <a :href="canPurchase ? checkoutUrl : '#'"
                                        :class="{
                                            'bg-gradient-to-r from-orange-300 to-orange-500': canPurchase,
                                            'bg-gray-300 cursor-not-allowed opacity-70': !canPurchase
                                        }"
                                        class="text-white px-8 py-3 rounded-lg font-semibold transition-all"
                                        @click.prevent="handleButtonClick">
                                        Pesan Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('checkout', ['product' => $product->id]) }}"
                                        class="bg-gradient-to-r from-orange-300 to-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                                        Pesan Sekarang
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function flashSale(config) {
                        return {
                            saleStatus: 'waiting',
                            hours: 0,
                            minutes: 0,
                            seconds: 0,
                            currentStock: config.currentStock,
                            startTime: config.startTime ? new Date(config.startTime) : null,
                            endTime: config.endTime ? new Date(config.endTime) : null,
                            normalPrice: config.normalPrice,
                            flashPrice: config.flashPrice,
                            productId: config.productId,
                            checkoutUrl: `{{ route('checkout', ['product' => ':productId']) }}`.replace(':productId', config
                                .productId),

                            init() {
                                console.log('Debug info:');
                                console.log('Start time:', this.startTime);
                                console.log('End time:', this.endTime);
                                console.log('Current time:', new Date());

                                if (!this.startTime || !this.endTime) {
                                    console.log('No flash sale times available');
                                    this.saleStatus = 'no-sale';
                                    return;
                                }
                                this.updateCanPurchase();
                                this.updateTimer();
                                setInterval(() => {
                                    this.updateTimer();
                                    this.updateCanPurchase();
                                }, 1000);
                            },

                            updateTimer() {
                                if (!this.startTime || !this.endTime) return;

                                const now = new Date();
                                let targetTime;

                                if (now < this.startTime) {
                                    this.saleStatus = 'waiting';
                                    targetTime = this.startTime;
                                    console.log('Waiting for sale to start');
                                } else if (now >= this.startTime && now < this.endTime) {
                                    this.saleStatus = 'active';
                                    targetTime = this.endTime;
                                    console.log('Sale is active');
                                } else {
                                    this.saleStatus = 'ended';
                                    console.log('Sale has ended');
                                    this.hours = 0;
                                    this.minutes = 0;
                                    this.seconds = 0;
                                    return;
                                }

                                const diff = Math.max(0, targetTime - now);
                                this.hours = Math.floor(diff / (1000 * 60 * 60));
                                this.minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                this.seconds = Math.floor((diff % (1000 * 60)) / 1000);

                                console.log('Updated time left:', {
                                    hours: this.hours,
                                    minutes: this.minutes,
                                    seconds: this.seconds
                                });
                            },

                            updateCanPurchase() {
                                this.canPurchase = this.saleStatus === 'active';
                            },

                            getCurrentPrice() {
                                return this.saleStatus === 'active' ? this.flashPrice : this.normalPrice;
                            },

                            formatPrice(price) {
                                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            },

                            handleButtonClick() {
                                if (this.saleStatus === 'waiting') {
                                    alert("Flash sale belum mulai. Silakan tunggu hingga sale aktif.");
                                } else if (this.saleStatus === 'ended') {
                                    alert("Flash sale sudah berakhir.");
                                } else if (this.currentStock === 0) {
                                    alert("Stock Habis.");
                                } else {
                                    // Lanjutkan ke halaman checkout jika kondisi memenuhi
                                    window.location.href = this.checkoutUrl;
                                }

                            }
                        };
                    }
                </script>

            </div>
        </div>
    </div>

</html>
