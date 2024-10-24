@extends('public::layouts.main')
@section('content')
    <!-- Search Input with Filter -->
    <div class="max-w-[700px] mx-auto mb-5 p-4">
        <div class="relative">
            <!-- Search Input -->
            <div class="relative w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search-input"
                    class="bg-gray-50 border rounded-lg border-orange-300 text-gray-900 text-sm focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 pr-10 p-2.5"
                    placeholder="Cari produk yang anda inginkan..." required>

                <!-- Filter Button -->
                <button type="button" onclick="toggleModal()"
                    class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Filter Modal -->
        <div id="filterModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40">
            <div
                class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-gray-100 shadow-lg  rounded-lg p-6 w-96 max-w-full">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Filter by Category</h3>
                    <button onclick="toggleModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filter Options -->
                <div class="space-y-4">
                    @foreach ($categories as $category)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" value="{{ $category->id }}" data-category-id="{{ $category->id }}"
                                class="category-checkbox rounded border-orange-300 text-orange-600 focus:ring-orange-500">
                            <span class="text-gray-700">{{ $category->category_name }}</span>
                        </label>
                    @endforeach
                </div>

                <!-- Filter Actions -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button onclick="toggleModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button onclick="applyFilter()"
                        class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-orange-400 to-orange-500 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Apply Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="py-0">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-20 md:px-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">
                @foreach ($products as $item)
                    <a href="{{ route('products.detail', $item) }}"
                        class="relative bg-cover group rounded-3xl bg-center overflow-hidden mx-auto sm:mr-0 xl:mx-auto cursor-pointer">
                        <img class="rounded-2xl object-cover" src="{{ $item->getFirstMediaUrl('images') }}"
                            alt="Product image">
                        <div
                            class="absolute z-10 bottom-3 left-0 mx-3 p-3 bg-white w-[calc(100%-24px)] rounded-xl shadow-sm shadow-transparent transition-all duration-500 group-hover:shadow-indigo-200 group-hover:bg-indigo-50">
                            <div class="flex items-center justify-between mb-2">
                                <h6 class="font-semibold text-base leading-7 text-black">{{ $item->product_name }}</h6>
                                <h6 class="font-semibold text-base leading-7 text-indigo-600 text-right">
                                    {{ format_currency($item->product_price) }}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        let selectedCategories = [];
        let searchTimer;

        function toggleModal() {
            const modal = document.getElementById('filterModal');
            modal.classList.toggle('hidden');
        }

        function showLoading() {
            const gridContainer = document.querySelector('.grid');
            gridContainer.style.opacity = '0.5';
        }

        function hideLoading() {
            const gridContainer = document.querySelector('.grid');
            gridContainer.style.opacity = '1';
        }

        function applyFilter() {
            selectedCategories = [];
            document.querySelectorAll('.category-checkbox:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.dataset.categoryId);
            });
            performSearch();
            toggleModal();
        }

        function performSearch() {
            const query = $('#search-input').val();
            showLoading();

            $.ajax({
                url: '{{ route('products.search') }}',
                method: 'GET',
                data: {
                    query: query,
                    categories: selectedCategories
                },
                success: function(response) {
                    updateProductGrid(response.products);
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mencari produk!'
                    });
                },
                complete: function() {
                    hideLoading();
                }
            });
        }

        function updateProductGrid(products) {
            const gridContainer = document.querySelector('.grid');

            if (products.length === 0) {
                gridContainer.innerHTML = `
                    <div class="col-span-full text-center py-10">
                        <h3 class="text-lg text-gray-500">Tidak ada produk yang ditemukan</h3>
                    </div>
                `;
                return;
            }

            let html = '';
            products.forEach(product => {
                html += `
                    <a href="/products-detail/${product.id}" class="relative bg-cover group rounded-3xl bg-center overflow-hidden mx-auto sm:mr-0 xl:mx-auto cursor-pointer">
                        <img class="rounded-2xl object-cover" src="${product.image}" alt="${product.product_name}">
                        <div class="absolute z-10 bottom-3 left-0 mx-3 p-3 bg-white w-[calc(100%-24px)] rounded-xl shadow-sm shadow-transparent transition-all duration-500 group-hover:shadow-indigo-200 group-hover:bg-indigo-50">
                            <div class="flex items-center justify-between mb-2">
                                <h6 class="font-semibold text-base leading-7 text-black">${product.product_name}</h6>
                                <h6 class="font-semibold text-base leading-7 text-indigo-600 text-right">Rp. ${product.product_price}</h6>
                            </div>
                        </div>
                    </a>
                `;
            });

            gridContainer.innerHTML = html;
        }

        // Search implementation with debounce
        $(document).ready(function() {
            const originalGrid = document.querySelector('.grid').innerHTML;

            $('#search-input').on('keyup', function() {
                clearTimeout(searchTimer);

                const query = $(this).val();
                if (query.length === 0) {
                    document.querySelector('.grid').innerHTML = originalGrid;
                    return;
                }

                searchTimer = setTimeout(performSearch, 500);
            });
        });
    </script>
@endsection
