<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithStyles
{
    protected $sales;
    protected $totalProfit;

    public function __construct($sales, $totalProfit)
    {
        $this->sales = $sales;
        $this->totalProfit = $totalProfit;
    }

    public function collection()
    {
        return $this->sales;
    }

    public function headings(): array
    {
        return [
            __('messages.productname'),
            __('messages.branches'),
            __('messages.customername'),
            __('messages.status'),
            __('messages.totalamount'),
            __('messages.paidamount'),
            __('messages.dueamount'),
            __('messages.profit'),
            __('messages.date'),
        ];
    }

    public function map($sale): array
    {
        $profit = 0;
        foreach ($sale->saleDetails as $detail) {
            $profit += ($detail->unit_price - $detail->product->purchase_price) * $detail->quantity;
        }

        return [
            $sale->saleDetails->map(function ($detail) {
                return $detail->product->product_name;
            })->implode(', '),
            $sale->branch->name,
            $sale->customer_name,
            $sale->status,
            format_currency($sale->total_amount),
            format_currency($sale->paid_amount),
            format_currency($sale->due_amount),
            format_currency($profit),
            $sale->created_at->format('Y-m-d'),
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function styles(Worksheet $sheet)
    {
        // Add total profit at the top
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Total Profit: ' . format_currency($this->totalProfit));

        // Style the header
        $sheet->getStyle('A2:I2')->applyFromArray([
            'font' => ['bold' => true],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
    }
}
