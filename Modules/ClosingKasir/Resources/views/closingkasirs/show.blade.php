@extends('layouts.app')

@section('title', 'Laporan Closing Kasir')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('closingkasir.index') }}">Laporan Closing Kasir</a></li>
        <li class="breadcrumb-item active">{{ __('messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

    <div class="container-fluid mb-4">
        <div class="d-flex justify-content-end no-print">
            <button onclick="window.print()" class="btn btn-primary mb-4"><i class="fa fa-print"></i> Print</button>
        </div>

        <div class="print-area p-4 border">
            <h2 class="text-center">LAPORAN CLOSING KASIR</h2>
            <h4 class="text-center">Tanggal: {{ \Carbon\Carbon::parse($closing->tanggal)->format('d M Y') }} -
                {{ $closing->branch->name }}</h4>
            <br>


            <hr>

            <p><strong>Detail Penjualan</strong></p>
            @if ($penjualan_items->isNotEmpty())
                @foreach ($penjualan_items as $penjualan)
                    @if ($penjualan->saleDetails->isNotEmpty())
                        <ul>
                            @foreach ($penjualan->saleDetails as $item)
                                <li>{{ $item->product_name }} - {{ $item->quantity }} pcs x Rp
                                    {{ number_format($item->price, 0, ',', '.') }} = Rp
                                    {{ number_format($item->sub_total, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            @else
                <p>Tidak ada data penjualan.</p>
            @endif

            <hr>
            <p><strong>Detail Pengeluaran</strong></p>
            @if ($pengeluaran_items->isNotEmpty())
                <ul>
                    @foreach ($pengeluaran_items as $item)
                        <li>{{ $item->details }} - Rp {{ number_format($item->amount, 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada data pengeluaran.</p>
            @endif
            <br>
            <div class="row mt-5">
                <div class="col-md-6">
                    <p><strong>Total Penjualan: Rp {{ number_format($closing->total_penjualan, 0, ',', '.') }} </strong>
                    </p>
                    <p><strong>Total Pengeluaran: Rp {{ number_format($closing->total_pengeluaran, 0, ',', '.') }}
                        </strong>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Selisih Tidak Tercatat: Rp
                            {{ number_format($closing->selisih_manual, 0, ',', '.') }} </strong> </p>
                    <p><strong>Total Disetorkan: Rp {{ number_format($closing->total_setoran, 0, ',', '.') }} </strong>
                    </p>
                </div>
            </div>

            <br>
            <div class="text-end mt-5">
                <p>Mengetahui,</p>
                <br><br>
                <p><strong>(....................)</strong></p>
                <p>Manager</p>
            </div>
        </div>
    </div>
@endsection
