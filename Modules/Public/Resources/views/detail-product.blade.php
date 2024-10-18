@extends('public::layouts.app')

@section('title', $product->product_name . ' | Product')

@push('style')
@endpush

@section('content')
    <div class="container pt-5">
        <div class="container pt-5">
            <div class="container pt-5">
                <div class="card p-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            {{-- <div class="white-box text-center"><img src="https://www.bootdey.com/image/400x400/00CED1/000000"
                                    class="img-responsive"></div> --}}
                            @forelse($product->getMedia('images') as $media)
                                <img src="{{ $media->getUrl() }}" alt="Product Image" class="img-fluid img-thumbnail mb-2"
                                    style="width: 400px; height: 400px; object-fit: cover;">
                            @empty
                                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image"
                                    class="img-fluid img-thumbnail mb-2">
                            @endforelse
                        </div>
                        <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                            <h3>{{ $product->product_name }}</h3>
                            <p>product by Admin ReangNET</p>

                            <p class="pt-3">
                                Stock <b>{{ $product->product_quantity . ' ' . $product->product_unit }}</b>
                            </p>
                            <h4 class="pb-2">{{ format_currency($product->product_price) }} <small>non tax</small></h4>

                            <a href="{{ route('public.store') }}" style="text-decoration: none">
                                <button class="btn btn-outline-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    &nbsp;&nbsp;&nbsp;Back
                                </button>
                            </a>
                            &nbsp;
                            <button class="btn btn-primary">
                                <i class="fa fa-shopping-cart"></i>
                                &nbsp;&nbsp;&nbsp;Add to cart
                            </button>

                            <p class="pt-4" style="font-weight: 600">Product description:</p>
                            <p class="text-justify">
                                {{ $product->product_note }}
                            </p>
                        </div>

                        {{-- <h4 class="pt-5">Product details</h4> --}}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mt-5 mb-4">General Info</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-product">
                                    <tbody>
                                        <tr>
                                            <td width="390">Name</td>
                                            <td>{{ $product->product_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td>{{ $product->category->category_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td>{{ format_currency($product->product_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td>{{ $product->product_quantity . ' ' . $product->product_unit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
