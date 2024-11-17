@extends('layouts.app')

@section('title', 'Create Productstock')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productstocks.index') }}">Productstock</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ol>
@endsection
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        width: 25px;
        height: 25px;
        margin: 0;
        padding: 0;
    }

    .rating label i {
        color: #ddd;
    }

    .rating input:checked~label i {
        color: #ffd700;
    }
</style>
@section('content')
    <div class="container-fluid">
        <form id="product-form" action="{{ route('productstocks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">{{ __('messages.create') }} Productstock <i
                                class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">

                                <div class="col-lg-4">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="product_id">Product <span class="text-danger">*</span></label>
                                            <select class="form-control select2-products" name="product_id" id="product_id"
                                                required>
                                                <option value="">{{ __('messages.select_product') }}</option>
                                                @foreach (\Modules\Product\Entities\Product::all() as $product)
                                                    <option value="{{ $product->id }}"> {{ $product->product_name }} |
                                                        {{ format_currency($product->product_price) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="branch_id">{{ __('messages.branches') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="branch_id" id="branch_id" required>
                                                <option value="">{{ __('messages.select_branch') }}</option>
                                                @foreach (\Modules\Branch\Entities\Branch::all() as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="quantity">{{ __('messages.quantity') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="quantity" required
                                                value="{{ old('quantity') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
@endsection
@push('scripts')
    {{-- Tambahkan di head --}}

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS (setelah jQuery) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan jQuery sudah dimuat
            if (typeof jQuery != 'undefined') {
                // Inisialisasi Select2
                $('.select2-products').select2({
                    placeholder: 'Cari produk...',
                    allowClear: true,
                    width: '100%'
                });
            } else {
                console.error('jQuery tidak dimuat dengan benar');
            }
        });
    </script>
@endpush
