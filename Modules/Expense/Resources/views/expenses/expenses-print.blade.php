<!DOCTYPE html>
<html>
<head>
    <title>Expenses Report</title>
    <style>
        /* Reset default margins and set base font size */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        /* A4 paper styling */
        @page {
            size: A4;
            margin: 0;
        }

        /* Container for content with margins */
        .container {
            width: 210mm;
            margin: 0 auto;
            padding: 20mm 25mm; /* Larger margins for A4 paper */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .report-info {
            margin-bottom: 15px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 10px;
        }

        th, td {
            padding: 6px 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        /* Optimize table for narrow columns */
        th:nth-child(1), td:nth-child(1) { width: 10%; } /* Date */
        th:nth-child(2), td:nth-child(2) { width: 20%; } /* Product */
        th:nth-child(3), td:nth-child(3) { width: 10%; } /* Branch */
        th:nth-child(4), td:nth-child(4) { width: 15%; } /* Customer */
        th:nth-child(5), td:nth-child(5) { width: 10%; } /* Status */
        th:nth-child(6), td:nth-child(6) { width: 12%; } /* Total */
        th:nth-child(7), td:nth-child(7) { width: 12%; } /* Paid */
        th:nth-child(8), td:nth-child(8) { width: 11%; } /* Due */

        .product-list {
            list-style-position: inside;
            padding: 0;
            margin: 0;
        }

        .product-list li {
            font-size: 10px;
            margin-bottom: 2px;
        }

        .totals {
            margin-top: 15px;
            text-align: right;
            font-size: 11px;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: normal;
            display: inline-block;
        }

        .badge-success { background-color: #28a745; color: white; }
        .badge-warning { background-color: #ffc107; color: black; }
        .badge-danger { background-color: #dc3545; color: white; }
        .badge-info { background-color: #17a2b8; color: white; }
        .badge-primary { background-color: #007bff; color: white; }

        /* Print-specific styles */
        @media print {
            .no-print { display: none; }

            .container {
                width: 100%;
                margin: 0;
                padding: 20mm 25mm;
            }

            /* Ensure page breaks don't occur inside rows */
            tr { page-break-inside: avoid; }

            /* Add page numbers */
            @page {
                margin: 20mm 25mm;
            }

            /* Improve table readability in print */
            th {
                background-color: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Ensure badges print with background colors */
            .badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('messages.expenses_report') }}</h1>
        </div>

        <div class="report-info">
            <p><strong>{{ __('messages.period') }}:</strong> {{ \Carbon\Carbon::parse($start_date)->format('d M, Y') }} -
                {{ \Carbon\Carbon::parse($end_date)->format('d M, Y') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.details') }}</th>
                    <th>{{ __('messages.branches') }}</th>
                    <th>{{ __('messages.amount') }}</th>

                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $expense)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}</td>
                        <td>{{ $expense->details }}</td>
                        <td>{{ $expense->branch->name }}</td>
                        <td>{{ format_currency($expense->amount) }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No Expenses Data Available!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="totals">
            <p><strong>{{ __('messages.total') }}:</strong> {{ format_currency($totalExpenses) }}</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
            loading_is = false;
            window.close();

        }
    </script>
</body>
</html>
