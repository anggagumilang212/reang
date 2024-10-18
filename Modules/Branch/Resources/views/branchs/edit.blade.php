@extends('layouts.app')

@section('title', 'Edit Branch')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('branchs.index') }}">Branch</a></li>
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
        <form id="product-form" action="{{ route('branchs.update', $Branch->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Update Cabang Toko <i class="bi bi-check"></i></button>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Toko <span class="text-danger">*</span></label>
                                    <input id="name" type="text" class="form-control" name="name" required
                                        value="{{ $Branch->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">No Telpon <span class="text-danger">*</span></label>
                                    <input id="phone" type="text" class="form-control" name="phone" required
                                        value="{{ $Branch->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat<span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" rows="4 " class="form-control" value="{{ $Branch->address }}">{{ $Branch->address }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </form>
    </div>
@endsection
