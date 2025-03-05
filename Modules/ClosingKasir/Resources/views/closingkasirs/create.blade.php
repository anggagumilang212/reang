@extends('layouts.app')

@section('title', 'Create Banner')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('closingkasir.index') }}">Closing Kasir</a></li>
        <li class="breadcrumb-item active">{{ __('messages.add') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="closingkasir-form" action="{{ route('closingkasir.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        {{-- <button class="btn btn-primary">{{ __('messages.create') }} {{ __('messages.banner') }} <i
                                class="bi bi-check"></i></button> --}}
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title
                            ">Laporan Closing Kasir</h4>
                            {{-- pilih branch --}}
                            <div class="mb-3">
                                <label for="branch_id" class="form-label">Cabang Toko</label>
                                <select name="branch_id" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>

                            <div class="mb-3">
                                <label for="selisih_manual" class="form-label">Selisih Tidak Tercatat (kosongkan jika tidak
                                    ada)</label>
                                <input type="text" id="selisih_manual" step="0.01" name="selisih_manual"
                                    class="form-control">
                            </div>

                            <button class="btn btn-primary">Simpan CLosing Kasir <i class="bi bi-check"></i></button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#selisih_manual').maskMoney({
                prefix: '{{ settings()->currency->symbol }}',
                thousands: '{{ settings()->currency->thousand_separator }}',
                decimal: '{{ settings()->currency->decimal_separator }}',
            });

            $('#closingkasir-form').submit(function() {
                var amount = $('#selisih_manual').maskMoney('unmasked')[0];
                $('#selisih_manual').val(amount);
            });
        });
    </script>
@endpush
