<!-- resources/views/transfer/show.blade.php -->
@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('transferstock.index') }}">{{ __('messages.transfer_stock') }}</a></li>
        <li class="breadcrumb-item active">Detail {{ __('messages.transfer_stock') }}</li>
    </ol>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.transfer_stock') }} Details</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            {{-- <h5>Reference: {{ $transfer->reference }}</h5> --}}
                            <h5>{{ __('messages.date') }}: {{ $transfer->created_at->format('d/m/Y H:i') }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="badge bg-success text-white">
                                {{ $transfer->status }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>{{ __('messages.frombranch') }}</h6>
                            <p>{{ $transfer->fromBranch->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>{{ __('messages.tobranch') }}</h6>
                            <p>{{ $transfer->toBranch->name }}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.products') }}</th>
                                    {{-- <th>Code</th> --}}
                                    <th>{{ __('messages.quantity') }}</th>
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
                        <h6>{{ __('messages.note') }}:</h6>
                        <p>{{ $transfer->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
