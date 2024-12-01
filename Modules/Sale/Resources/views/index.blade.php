@extends('layouts.app')

@section('title', 'Sales')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.sales') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <a href="{{ route('sales.create') }}" class="btn btn-primary" style="margin-right: 20px">
                                {{ __('messages.add') }} <i class="bi bi-plus"></i>
                            </a>
                            <a href="{{ route('sales-report.index') }}" class="text-decoration-none flex-grow-1">
                                <div class="alert alert-danger d-flex align-items-center justify-content-center m-0 p-2" role="alert"
                                    style="background: linear-gradient(45deg, #dc3545, #ff4d4d); border: none; color: white; box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <div class="text-center">
                                        Untuk pengambilan laporan penjualan silahkan klik di sini!
                                    </div>
                                </div>
                            </a>
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
    <!-- Date Range Modal -->
    <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Filter {{ __('messages.date') }}</h5>
                    {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    {{-- <p>Pilih cabang toko terlebih dahulu sebelum memilih tanggal</p> --}}
                    <form id="dateRangeForm">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">{{ __('messages.start_date') }}</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">{{ __('messages.end_date') }}</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="applyDateFilter">Terapkan Filter</button>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script>
        $(document).ready(function() {
            // Handle apply date filter
            $('#applyDateFilter').on('click', function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                if (start_date && end_date) {
                    var table = $('#sales-table').DataTable();
                    var currentUrl = table.ajax.url();
                    var baseUrl = currentUrl.split('?')[0];
                    var branchParam = '';

                    // Preserve branch_id parameter if exists
                    if (currentUrl.includes('branch_id=')) {
                        branchParam = '&' + currentUrl.split('?')[1];
                    }

                    var newUrl = baseUrl + '?start_date=' + start_date + '&end_date=' + end_date +
                        branchParam;
                    table.ajax.url(newUrl).load();

                    $('#dateRangeModal').modal('hide');
                } else {
                    alert('Silakan pilih tanggal awal dan akhir');
                }
            });

            // Reset date filter when modal is hidden
            $('#dateRangeModal').on('hidden.bs.modal', function() {
                $('#dateRangeForm')[0].reset();
            });
        });
    </script>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
