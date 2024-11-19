<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Print Struk</title>
    <style>
        @page {
            size: 58mm 297mm;
            margin: 0;

        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        body {
            width: 58mm;
            margin: 0;
            padding: 0;
            font-family: 'Courier New', monospace;
            font-size: 9px;
            line-height: 1.2;
            display: block; /* Mengubah ke block dari flex */
            color: #000; /* Hitam pekat */
            font-weight: 700; /* Tebalkan teks */

        }

        .receipt-wrapper {
            width: 58mm;
            margin: 0;
            padding: 0;
            text-align: center; /* Mengatur alignment center untuk wrapper */

        }

        .receipt {
            width: 48mm;
            display: inline-block; /* Mengubah ke inline-block */
            text-align: left; /* Mengembalikan alignment teks ke kiri */
            margin: 0 5mm; /* Margin kiri-kanan otomatis untuk centering */
            padding: 2mm 0;
            color: #000; /* Hitam pekat */
            font-weight: 700; /* Tebalkan teks */
        }

        .header {
            text-align: center;
            margin-bottom: 3mm;
            color: #000; /* Hitam pekat */
            font-weight: 700; /* Tebalkan teks */
        }

        .shop-name {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 1mm;
            text-align: center;
            color: #000; /* Hitam pekat */
            font-weight: 700; /* Tebalkan teks */
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 2mm 0;
            width: 100%;
        }

        .transaction-info {
            margin-bottom: 2mm;
        }

        .items {
            width: 100%;
        }

        .item {
            margin-bottom: 1mm;
        }

        .item-name {
            margin-bottom: 0.5mm;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            padding-left: 2mm;
        }

        .summary {
            margin-top: 2mm;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5mm;
        }

        .footer {
            margin-top: 3mm;
            text-align: center;
            font-size: 8px;
        }

        @media print {
            html, body {
                width: 58mm !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .receipt-wrapper {
                width: 58mm !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .receipt {
                width: 48mm !important;
                margin: 0 5mm !important;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-wrapper">
        <div class="receipt">
            <div class="header">
                <div class="shop-name">{{ settings()->company_name }}</div>
                <div>{{ $sale->branch->address }}</div>
                <div>{{ $sale->branch->phone }}</div>
            </div>

            <div class="divider"></div>

            <div class="transaction-info">
                <div style="display: flex; justify-content: space-between;">
                                 <div>{{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }} {{ \Carbon\Carbon::parse($sale->created_at)->format('H:i') }}</div>
                    <div>{{ $sale->customer_name }}</div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="items">
                @foreach ($sale->saleDetails as $saleDetail)
                    <div class="item">
                        <div class="item-name">{{ $saleDetail->product->product_name }}</div>
                        <div class="item-detail">
                            <div>{{ $saleDetail->quantity }}x{{ format_currency($saleDetail->price) }}</div>
                            <div>{{ format_currency($saleDetail->sub_total) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="divider"></div>

            <div class="summary">
                <div class="summary-item">
                    <div>{{ __('messages.sub_total') }}</div>
                    <div>{{ format_currency($saleDetail->sub_total) }}</div>
                </div>
                <div class="summary-item">
                    <div>{{ __('messages.totalamount') }}</div>
                    <div>{{ format_currency($sale->total_amount) }}</div>
                </div>
                <div class="summary-item">
                    <div>{{ __('messages.paidamount')}} {{ $sale->payment_method }}</div>
                    <div>{{ format_currency($sale->paid_amount) }}</div>
                </div>
                <div class="summary-item">
                    <div>{{ __('messages.dueamount') }}</div>
                    <div>{{ format_currency($sale->due_amount) }}</div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="footer">
                Link {{ __('messages.kritik_saran') }}:<br>
                reang.net
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
