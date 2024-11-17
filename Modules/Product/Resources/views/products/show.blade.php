@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">{{ __('messages.products') }}</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
                {!! \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG(
                    $product->product_code,
                    $product->product_barcode_symbology,
                    2,
                    110,
                ) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>{{ __('messages.products') }} {{ __('messages.code') }}</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.barcodesymbology') }}</th>
                                    <td>{{ $product->product_barcode_symbology }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.productname') }}</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.category') }}</th>
                                    <td>{{ $product->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.cost') }}</th>
                                    <td>{{ format_currency($product->product_cost) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.price') }}</th>
                                    <td>{{ format_currency($product->product_price) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.quantity') }}</th>
                                    <td>{{ $product->productStock->quantity??'0' }} {{ $product->product_unit }}</td>
                                </tr>
                                <tr>
                                    <th>Stock Worth</th>
                                    <td>
                                        COST:: {{ format_currency($product->product_cost * (optional($product->productStock)->quantity ?? 0)) }} /
                                        PRICE:: {{ format_currency($product->product_price * (optional($product->productStock)->quantity ?? 0)) }}
                                    </td>

                                </tr>
                                {{-- <tr>
                                    <th>Alert Quantity</th>
                                    <td>{{ $product->product_alert_quantity }}</td>
                                </tr> --}}
                                <tr>
                                    <th>{{ __('messages.order_tax') }} (%)</th>
                                    <td>{{ $product->product_order_tax ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.taxtype') }}</th>
                                    <td>
                                        @if ($product->product_tax_type == 1)
                                            Exclusive
                                        @elseif($product->product_tax_type == 2)
                                            Inclusive
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.note') }}</th>
                                    <td>{{ $product->product_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        @forelse($product->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image"
                                class="img-fluid img-thumbnail mb-2">
                        @endforelse
                        {{-- <img src="{{ $product->getFirstMediaUrl('barcode') }}" alt="Barcode Image"   class="img-fluid img-thumbnail mb-2"/> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
