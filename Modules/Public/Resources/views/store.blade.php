@extends('public::layouts.app')

@section('title', 'Store')

@push('style')
@endpush

@section('content')
    <div class="container pt-5">
        <div class="container pt-5">
            <div class="row pt-5">
                <div class="col-sm-4 col-md-3">
                    <div class="well">
                        <div class="row">
                            <form action="" method="GET" class="form-inline form-row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <input type="search" value="{{ request()->get('keyword') }}" name="keyword"
                                            class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Filter -->
                    <form class="shop__filter">
                        <!-- Price -->
                        <h4 class="headline pt-4">
                            <span>Price</span>
                        </h4>
                        <div class="radio">
                            <input type="radio" name="shop-filter__price" id="shop-filter-price_1" value=""
                                checked="">
                            <label for="shop-filter-price_1">Under $25</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__price" id="shop-filter-price_2" value="">
                            <label for="shop-filter-price_2">$25 to $50</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__price" id="shop-filter-price_3" value="">
                            <label for="shop-filter-price_3">$50 to $100</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__price" id="shop-filter-price_4" value="specify">
                            <label for="shop-filter-price_4">Other (specify)</label>
                        </div>
                        <div class="form-group shop-filter__price">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="shop-filter-price_from" class="sr-only"></label>
                                    <input id="shop-filter-price_from" type="number" min="0" class="form-control"
                                        placeholder="From" disabled="">
                                </div>
                                <div class="col-xs-4">
                                    <label for="shop-filter-price_to" class="sr-only"></label>
                                    <input id="shop-filter-price_to" type="number" min="0" class="form-control"
                                        placeholder="To" disabled="">
                                </div>
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-block btn-default" disabled="">Go</button>
                                </div>
                            </div>
                        </div>

                        <!-- Checkboxes -->
                        <h4 class="headline">
                            <span>Brand</span>
                        </h4>
                        <div class="checkbox">
                            <input type="checkbox" value="" id="shop-filter-checkbox_1" checked="">
                            <label for="shop-filter-checkbox_1">Joyko</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" value="" id="shop-filter-checkbox_2">
                            <label for="shop-filter-checkbox_2">Kenko</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" value="" id="shop-filter-checkbox_3">
                            <label for="shop-filter-checkbox_3">Snowman</label>
                        </div>

                        <!-- Radios -->
                        <h4 class="headline pt-4">
                            <span>Material</span>
                        </h4>
                        <div class="radio">
                            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_1" value=""
                                checked="">
                            <label for="shop-filter-radio_1">100% Cotton</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_2" value="">
                            <label for="shop-filter-radio_2">Bamboo</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_3" value="">
                            <label for="shop-filter-radio_3">Leather</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_4" value="">
                            <label for="shop-filter-radio_4">Polyester</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="shop-filter__radio" id="shop-filter-radio_5" value="">
                            <label for="shop-filter-radio_5">Not specified</label>
                        </div>

                        <!-- Colors -->
                        <h4 class="headline pt-4">
                            <span>Colors</span>
                        </h4>
                        <div class="shop-filter__color">
                            <input type="text" id="shop-filter-color_1" value="" data-input-color="black">
                            <label for="shop-filter-color_1" style="background-color: black;"></label>
                        </div>
                        <div class="shop-filter__color">
                            <input type="text" id="shop-filter-color_2" value="" data-input-color="gray">
                            <label for="shop-filter-color_2" style="background-color: gray;"></label>
                        </div>
                        <div class="shop-filter__color">
                            <input type="text" id="shop-filter-color_3" value="" data-input-color="brown">
                            <label for="shop-filter-color_3" style="background-color: brown;"></label>
                        </div>
                        <div class="shop-filter__color">
                            <input type="text" id="shop-filter-color_4" value="" data-input-color="beige">
                            <label for="shop-filter-color_4" style="background-color: beige;"></label>
                        </div>
                        <div class="shop-filter__color">
                            <input type="text" id="shop-filter-color_5" value="" data-input-color="white">
                            <label for="shop-filter-color_5" style="background-color: white;"></label>
                        </div>
                    </form>
                </div>

                <div class="col-sm-8 col-md-9">
                    <!-- Filters -->
                    <ul class="shop__sorting">
                        <li class="{{ empty(request('sort')) == 'all' ? 'active' : '' }}"><a
                                href="{{ route('public.store') }}">all</a></li>
                        <li class="{{ request('sort') == 'newest' ? 'active' : '' }}"><a
                                href="{{ route('public.store', ['sort' => 'newest']) }}">Newest</a></li>
                        <li class="{{ request('sort') == 'price_low' ? 'active' : '' }}"><a
                                href="{{ route('public.store', ['sort' => 'price_low']) }}">Price (low)</a></li>
                        <li class="{{ request('sort') == 'price_high' ? 'active' : '' }}"><a
                                href="{{ route('public.store', ['sort' => 'price_high']) }}">Price (high)</a></li>
                    </ul>
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="shop__thumb">
                                    <a href="{{ route('public.product-detail', ['product' => $product]) }}">
                                        <div class="shop-thumb__img">
                                            @forelse($product->getMedia('images') as $media)
                                                <img src="{{ $media->getUrl() }}" alt="Product Image"
                                                    class="img-fluid img-thumbnail mb-2"
                                                    style="width: 200px; height: 200px; object-fit: cover;">
                                            @empty
                                                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image"
                                                    class="img-fluid img-thumbnail mb-2">
                                            @endforelse
                                        </div>
                                        <h5 class="shop-thumb__title">
                                            {{ $product->product_name }}
                                        </h5>
                                        <div class="shop-thumb__price">
                                            {{ format_currency($product->product_price) }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center m-5 p-5">
                                {{-- <img src="{{ asset('images/fallback_product_image.png') }}" alt="no_product"
                                    class="img-fluid"
                                    style="display: block; margin-left: auto; margin-right: auto; width: 200px; height: 200px;"> --}}
                                <i class="fa fa-times-circle-o" style="font-size:52px;color:red"></i>
                                <h5 class="pt-3">Tidak ada data product!</h5>
                            </div>
                        @endforelse
                    </div> <!-- / .row -->
                    <!-- Pagination -->
                    @if ($products->count() > 0)
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="pagination pagination-primary pull-right">
                                    <li class="page-item{{ $products->onFirstPage() ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                            tabindex="-1">Previous</a>
                                    </li>
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="page-item{{ $page === $products->currentPage() ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item{{ $products->hasMorePages() ? '' : ' disabled' }}">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div> <!-- / .row -->
                    @else
                    @endif
                </div> <!-- / .col-sm-8 -->
            </div> <!-- / .row -->
        </div>
    </div>
@endsection

@push('scripts')
@endpush
