<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
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
                                <h2 class="text-xl font-semibold">{{ $product->product_name }}</h2>
                                <div class="flex items-center">
                                    {{-- <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="ml-1 text-gray-600">{{ $product->rating ?? '4.9' }}</span> --}}
                                    <span class="ml-1 text-gray-400">Stock : {{ $product->productStock->quantity ?? '0' }} </span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Tag -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-2xl font-bold">Rp
                                        {{ number_format($product->product_price, 0, ',', '.') }}</span>
                                </div>

                                <span
                                    class="bg-pink-500 text-white px-3 py-1 rounded-full text-sm">{{ $product->category->category_name }}</span>

                            </div>
                            <div class="flex items-center mt-2 text-green-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm">{{ $product->guarantee ?? 'Garansi uang pasti kembali' }}</span>
                            </div>
                        </div>

                        <!-- About Section -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Catatan Produk</h3>
                            <p class="text-gray-600">{{ $product->product_note }}</p>
                        </div>

                        <!-- Reviews and Ratings Section -->
                        <!-- Media Reviews -->
                        <div class="py-6 border-b" x-data="{ activeMedia: null }">
                            <h3 class="text-lg font-semibold mb-4">Customer Photos & Videos</h3>

                            <!-- Media Gallery -->
                            <div class="flex py-6 px-4 gap-4 overflow-x-auto pb-4">
                                <!-- Media items with active state -->
                                <template
                                    x-for="(media, index) in {{ $mediaReviews->toJson() }}"
                                    :key="index">
                                    <div class="relative min-w-[150px] cursor-pointer group"
                                        @click="activeMedia = media">
                                        <img
                                            :src="media.type === 'video' ? media.thumbnail : media.src"
                                            alt="Review"
                                            class="w-[150px] h-[150px] object-cover rounded-lg transition-all"
                                            :class="activeMedia === media ? 'ring-2 ring-orange-500' : 'group-hover:ring-2 group-hover:ring-orange-500'"
                                        >
                                        <template x-if="media.type === 'video'">
                                            <div class="absolute bottom-2 right-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </template>
                                    </div>
                                </template>

                                @if($mediaReviews->count() > 4)
                                    <div class="min-w-[150px] relative cursor-pointer group">
                                        <img :src="$mediaReviews[0].src" alt="Review"
                                            class="w-[150px] h-[150px] object-cover rounded-lg group-hover:ring-2 group-hover:ring-orange-500 transition-all">
                                        <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-semibold">+{{ $mediaReviews->count() - 4 }} more</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Selected Media Preview -->
                            <div x-show="activeMedia"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                class="mt-6">
                                <template x-if="activeMedia?.type === 'video'">
                                    <div class="aspect-video w-full max-w-3xl mx-auto bg-black rounded-lg">
                                        <video :src="activeMedia?.src" controls
                                            class="w-full h-full object-contain rounded-lg"></video>
                                    </div>
                                </template>

                                <template x-if="activeMedia?.type === 'image'">
                                    <div class="aspect-video w-full max-w-3xl mx-auto">
                                        <img :src="activeMedia?.src"
                                            class="w-full h-full object-contain rounded-lg"
                                            alt="Selected review">
                                    </div>
                                </template>
                            </div>
                        </div>
                        <!-- Written Reviews -->
                        <div class="pt-6">
                            {{-- <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold">Customer Reviews</h3>
                                <select
                                    class="border rounded-lg px-4 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option>Most Recent</option>
                                    <option>Highest Rated</option>
                                    <option>Lowest Rated</option>
                                    <option>Most Helpful</option>
                                </select>
                            </div> --}}

                            <!-- Individual Reviews -->
                            {{-- <div class="space-y-6">
                                <!-- Review 1 -->
                                <div class="border-b pb-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/images/hadi.jpg" alt="User" class="w-10 h-10 rounded-full">
                                        <div class="ml-4">
                                            <h4 class="font-semibold">Ahmad Hadi</h4>
                                            <div class="flex items-center">
                                                <div class="flex items-center text-yellow-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Fixed Bottom Card -->
                            <div class="fixed bottom-0 rounded-xl left-0 right-0 bg-white shadow-lg border-t p-4">
                                <div class="max-w-6xl mx-auto flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="text-gray-600 text-sm">Total Price</span>
                                        <span class="text-xl font-bold text-pink-500">Rp
                                            {{ number_format($product->product_price, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('checkout', ['product' => $product->id]) }}"
                                        class="bg-gradient-to-r from-orange-300 to-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>
