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
        .report-container {
            background-color: #fff;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 2.5rem;
            position: relative;
            margin-bottom: 2rem;
            border: 1px solid #e0e0e0;
        }

        .corner-decoration {
            position: absolute;
            width: 80px;
            height: 80px;
            opacity: 0.7;
        }

        .top-left {
            top: 0;
            left: 0;
        }

        .top-right {
            top: 0;
            right: 0;
            transform: rotate(90deg);
        }

        .bottom-left {
            bottom: 0;
            left: 0;
            transform: rotate(-90deg);
        }

        .bottom-right {
            bottom: 0;
            right: 0;
            transform: rotate(180deg);
        }

        .report-header {
            text-align: center;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #3490dc;
            margin-bottom: 2rem;
            position: relative;
        }

        .report-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #2c3e50;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .report-subtitle {
            font-family: 'Montserrat', sans-serif;
            color: #3490dc;
            font-weight: 500;
        }

        .report-logo {
            max-height: 60px;
            margin-bottom: 1rem;
        }

        .section {
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f8fafc;
            border-radius: 6px;
            border-left: 4px solid #3490dc;
        }

        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: #3490dc;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.5rem;
        }

        .item-list {
            list-style-type: none;
            padding-left: 0.5rem;
        }

        .item-list li {
            padding: 0.5rem;
            border-bottom: 1px dashed #e0e0e0;
            display: flex;
            justify-content: space-between;
        }

        .item-list li:last-child {
            border-bottom: none;
        }

        .totals-section {
            background-color: #f1f7ff;
            border-radius: 6px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .totals-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .total-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .total-value {
            font-weight: 700;
            color: #3490dc;
        }

        .signature-section {
            margin-top: 4rem;
            text-align: right;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-top: 4rem;
            margin-bottom: 0.5rem;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            opacity: 0.05;
            font-size: 8rem;
            font-weight: bold;
            color: #000;
            pointer-events: none;
            z-index: 0;
        }

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

            .report-container {
                box-shadow: none;
                border: none;
            }

            @page {
                size: A4;
                margin: 10mm;
            }
        }
    </style>

    <div class="container-fluid mb-4">
        <div class="d-flex justify-content-end no-print">
            <button onclick="window.print()" class="btn btn-primary mb-4">
                <i class="fa fa-print"></i> Print
            </button>
        </div>

        <div class="print-area report-container">
            <!-- Corner decorations -->
            <svg class="corner-decoration top-left" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,0 L100,0 L100,20 C60,20 20,60 20,100 L0,100 Z" fill="#3490dc" fill-opacity="0.1" />
                <path d="M0,0 L70,0 L70,10 C40,10 10,40 10,70 L0,70 Z" fill="#3490dc" fill-opacity="0.2" />
                <path d="M0,0 L40,0 L40,5 C20,5 5,20 5,40 L0,40 Z" fill="#3490dc" fill-opacity="0.3" />
            </svg>

            <svg class="corner-decoration top-right" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,0 L100,0 L100,20 C60,20 20,60 20,100 L0,100 Z" fill="#3490dc" fill-opacity="0.1" />
                <path d="M0,0 L70,0 L70,10 C40,10 10,40 10,70 L0,70 Z" fill="#3490dc" fill-opacity="0.2" />
                <path d="M0,0 L40,0 L40,5 C20,5 5,20 5,40 L0,40 Z" fill="#3490dc" fill-opacity="0.3" />
            </svg>

            <svg class="corner-decoration bottom-left" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,0 L100,0 L100,20 C60,20 20,60 20,100 L0,100 Z" fill="#3490dc" fill-opacity="0.1" />
                <path d="M0,0 L70,0 L70,10 C40,10 10,40 10,70 L0,70 Z" fill="#3490dc" fill-opacity="0.2" />
                <path d="M0,0 L40,0 L40,5 C20,5 5,20 5,40 L0,40 Z" fill="#3490dc" fill-opacity="0.3" />
            </svg>

            <svg class="corner-decoration bottom-right" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,0 L100,0 L100,20 C60,20 20,60 20,100 L0,100 Z" fill="#3490dc" fill-opacity="0.1" />
                <path d="M0,0 L70,0 L70,10 C40,10 10,40 10,70 L0,70 Z" fill="#3490dc" fill-opacity="0.2" />
                <path d="M0,0 L40,0 L40,5 C20,5 5,20 5,40 L0,40 Z" fill="#3490dc" fill-opacity="0.3" />
            </svg>

            <div class="watermark">CLOSING</div>

            <div class="report-header">
                <!-- Optional: Add a logo here -->
                <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="report-logo"> -->
                <h2 class="report-title">LAPORAN CLOSING KASIR</h2>
                <h4 class="report-subtitle">
                    <span>{{ $closing->branch->name }}</span> &bull;
                    <span>{{ \Carbon\Carbon::parse($closing->tanggal)->format('d F Y') }}</span>
                </h4>
            </div>

            {{-- @if ($penjualan_cash_items->isNotEmpty())
                <div class="section">
                    <h4 class="section-title">
                        <i class="fa fa-credit-card"></i> Detail Penjualan (Cash)
                    </h4>
                    <ul class="item-list">
                        @foreach ($penjualan_cash_items as $penjualan)
                            @if ($penjualan->saleDetails->isNotEmpty())
                                @foreach ($penjualan->saleDetails as $item)
                                    <li>
                                        <span>
                                            <strong>{{ $item->product_name }}</strong> - {{ $item->quantity }} pcs x Rp
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                        <span>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="section">
                    <h4 class="section-title">
                        <i class="fa fa-credit-card"></i> Detail Penjualan (Cash)
                    </h4>
                    <p class="text-muted">Tidak ada data penjualan (Cash).</p>
                </div>
            @endif --}}

            @if ($penjualan_non_cash_items->isNotEmpty())
                <div class="section">
                    <h4 class="section-title">
                        <i class="fa fa-credit-card"></i> Detail Penjualan (Transfer)
                    </h4>
                    <ul class="item-list">
                        @foreach ($penjualan_non_cash_items as $penjualan)
                            @if ($penjualan->saleDetails->isNotEmpty())
                                @foreach ($penjualan->saleDetails as $item)
                                    <li>
                                        <span>
                                            <strong>{{ $item->product_name }}</strong> - {{ $item->quantity }} pcs x Rp
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                        <span>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="section">
                    <h4 class="section-title">
                        <i class="fa fa-credit-card"></i> Detail Penjualan (Transfer)
                    </h4>
                    <p class="text-muted">Tidak ada data penjualan (Transfer).</p>
                </div>
            @endif

            <div class="section">
                <h4 class="section-title">
                    <i class="fa fa-money-bill"></i> Detail Pengeluaran
                </h4>
                @if ($pengeluaran_items->isNotEmpty())
                    <ul class="item-list">
                        @foreach ($pengeluaran_items as $item)
                            <li>
                                <span>{{ $item->details }}</span>
                                <span>Rp {{ number_format($item->amount, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada data pengeluaran.</p>
                @endif
            </div>

            <div class="totals-section">
                <div class="totals-row">
                    <span class="total-label">Total Penjualan:</span>
                    <span class="total-value">Rp {{ number_format($closing->total_penjualan, 0, ',', '.') }}</span>
                </div>
                <div class="totals-row">
                    <span class="total-label">Total Pengeluaran:</span>
                    <span class="total-value">Rp {{ number_format($closing->total_pengeluaran, 0, ',', '.') }}</span>
                </div>
                <div class="totals-row">
                    <span class="total-label">Selisih Tidak Tercatat:</span>
                    <span class="total-value">Rp {{ number_format($closing->selisih_manual, 0, ',', '.') }}</span>
                </div>
                <div class="totals-row">
                    <span class="total-label">Total Disetorkan:</span>
                    <span class="total-value">Rp {{ number_format($closing->total_setoran, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="signature-section">
                <p>Mengetahui,</p>
                <div class="signature-line"></div>
                <p><strong>(....................)</strong></p>
                <p>Manager</p>
            </div>
        </div>
    </div>
@endsection
