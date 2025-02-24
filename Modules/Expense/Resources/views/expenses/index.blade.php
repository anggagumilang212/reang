@extends('layouts.app')

@section('title', 'Expenses')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.expenses') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <a href="{{ route('expenses.create') }}" class="btn btn-primary" style="margin-right: 20px">
                                {{ __('messages.add') }} {{ __('messages.expenses') }} <i class="bi bi-plus"></i>
                            </a>

                        
                            <a href="{{ route('expenses-report.index') }}" class="text-decoration-none flex-grow-1">
                                <div class="alert blink-alert d-flex align-items-center justify-content-center m-0 p-2"
                                    role="alert">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <div class="text-center">
                                        Untuk pengambilan laporan pengeluaran silahkan klik di sini!
                                    </div>
                                </div>
                            </a>
                            <style>
                                @keyframes blink {
                                    0% {
                                        opacity: 1;
                                    }

                                    50% {
                                        opacity: 0.5;
                                    }

                                    100% {
                                        opacity: 1;
                                    }
                                }

                                .blink-alert {
                                    background: linear-gradient(45deg, #dc3545, #ff4d4d);
                                    border: none;
                                    color: white;
                                    box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
                                    animation: blink 1.5s infinite;
                                    /* Animasi berkedip setiap 1.5 detik */
                                }
                            </style>

                        </div>

                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
