<!DOCTYPE html>
<html>

<head>
    <title>Print Struk</title>
    <style>
        @page {
            size: 80mm auto;
            /* Ukuran kertas thermal printer standard */
            margin: 0;
        }

        body {
            font-family: 'Courier New', monospace;
            width: 80mm;
            /* Menambahkan style untuk posisi tengah */
            margin: 0 auto;
            padding: 8px;
            font-size: 12px;
            display: flex;
            justify-content: center;
        }

        .receipt {
            width: 100%;
            max-width: 80mm;
        }

        .header {
            text-align: center;
            /* Mengubah alignment header jadi center */
            margin-bottom: 5px;
        }

        .shop-name {
            font-size: 14px;
            font-weight: bold;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .transaction-info {
            margin-bottom: 5px;
        }

        .items {
            width: 100%;
        }

        .item {
            margin-bottom: 3px;
        }

        .item-name {
            margin-bottom: 2px;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            padding-left: 15px;
        }

        .summary {
            margin-top: 5px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            /* Mengubah alignment footer jadi center */
        }

        /* Container untuk tombol print */
        .print-container {
            text-align: center;
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }

            /* Memastikan struk tetap di tengah saat print */
            body {
                margin: 0 auto;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        {{-- <div class="no-print print-container">
           <button onclick="window.print()">Print Struk</button>
       </div> --}}

        <div class="header">
            <div class="shop-name">{{ settings()->company_name }}</div>
            <div>{{ $sale->branch->address }}</div>
            <div>{{ $sale->branch->phone }}</div>
        </div>

        <div class="divider"></div>

        <div class="transaction-info">
            <div style="display: flex; justify-content: space-between;">
                <div> {{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</div>
                <div> {{ $sale->customer_name }}</div>
            </div>

            {{-- <div>{{ $sale->reference }}</div> --}}
        </div>

        <div class="divider"></div>

        <div class="items">
            @foreach ($sale->saleDetails as $saleDetail)
                <div class="item">
                    <div class="item-name">{{ $saleDetail->product->product_name }}</div>
                    <div class="item-detail">
                        <div>({{ $saleDetail->quantity }} x {{ format_currency($saleDetail->price) }})</div>
                        <div>{{ format_currency($saleDetail->sub_total) }}</div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="divider"></div>

        <div class="summary">
            <div class="summary-item">
                <div>Sub Total</div>
                <div>{{ format_currency($saleDetail->sub_total) }}</div>
            </div>
            <div class="summary-item">
                <div>Total</div>
                <div>{{ format_currency($sale->total_amount) }}</div>
            </div>
            <div class="summary-item">
                <div>Bayar {{ $sale->payment_method }}</div>
                <div>{{ format_currency($sale->paid_amount) }}</div>
            </div>
            <div class="summary-item">
                <div>Kembali</div>
                <div>{{ format_currency($sale->due_amount) }}</div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="footer">
            Link Kritik dan Saran:<br>
            reang.net
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
