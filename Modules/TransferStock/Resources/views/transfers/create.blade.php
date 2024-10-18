@extends('layouts.app')

@section('title', 'Create Transferstock')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('transferstock.index') }}">Transferstock</a></li>
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
        <form id="product-form" action="{{ route('transfer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Create Transferstock <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="from_branch_id">Dari Cabang Toko <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="from_branch_id" id="from_branch_id" required>
                                                <option value="">Pilih Cabang Toko</option>
                                                @foreach (\Modules\Branch\Entities\Branch::all() as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="to_branch_id">Ke Cabang Toko <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="to_branch_id" id="to_branch_id" required>
                                                <option value="">Pilih Cabang Toko</option>
                                                @foreach (\Modules\Branch\Entities\Branch::all() as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="product_id">Product <span class="text-danger">*</span></label>
                                            <select class="form-control" name="product_id" id="product_id" required>
                                                <option value="">Pilih Product</option>
                                                @foreach (\Modules\Product\Entities\Product::all() as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="quantity" required
                                                value="{{ old('quantity') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="content">Catatan <span class="text-black">(opsional)</span></label>
                                        <textarea name="content" id="content" rows="4 " class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="alert alert-info" id="stock-info" style="display: none;">
                                            Available stock: <span id="available-stock">0</span>
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
