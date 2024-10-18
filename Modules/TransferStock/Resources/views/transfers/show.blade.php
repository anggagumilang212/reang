<!-- resources/views/transfer/show.blade.php -->
@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('transferstock.index') }}">Transferstock</a></li>
        <li class="breadcrumb-item active">Detail Transfer</li>
    </ol>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transfer Details</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            {{-- <h5>Reference: {{ $transfer->reference }}</h5> --}}
                            <h5>Date: {{ $transfer->created_at->format('d/m/Y H:i') }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="badge bg-success text-white">
                                {{ $transfer->status }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Dari Cabang Toko</h6>
                            <p>{{ $transfer->fromBranch->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Ke Cabang Toko</h6>
                            <p>{{ $transfer->toBranch->name }}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    {{-- <th>Code</th> --}}
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $transfer->product->product_name }}</td>
                                    {{-- <td>{{ $transfer->product->code }}</td> --}}
                                    <td>{{ $transfer->quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($transfer->notes)
                    <div class="mt-3">
                        <h6>Notes:</h6>
                        <p>{{ $transfer->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
