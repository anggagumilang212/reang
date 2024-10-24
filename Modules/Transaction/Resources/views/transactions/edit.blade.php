@extends('layouts.app')

@section('title', 'Edit Productstock')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productstocks.index') }}">Productstock</a></li>
        <li class="breadcrumb-item active">Edit</li>
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
    <div class="container-fluid mb-4">
        <form id="product-form" action="{{ route('productstocks.update', $Productstock->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Update Productstock <i class="bi bi-check"></i></button>
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
                                            <select class="form-control" name="product_id" id="product_id" required>
                                                @foreach (\Modules\Product\Entities\Product::all() as $product)
                                                    <option {{ $Productstock->product_id == $product->id ? 'selected' : '' }}
                                                        value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="branch_id">Cabang Toko <span class="text-danger">*</span></label>
                                            <select class="form-control" name="branch_id" id="branch_id" required>
                                                @foreach (\Modules\Branch\Entities\Branch::all() as $branch)
                                                    <option {{ $Productstock->branch_id == $branch->id ? 'selected' : '' }}
                                                        value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="quantity" required
                                                value="{{ $Productstock->quantity }}">
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
