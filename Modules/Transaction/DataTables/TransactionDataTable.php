<?php

namespace Modules\Transaction\DataTables;

use Modules\Transaction\Entities\Transaction;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('Transaction::transactions.partials.actions', compact('data'));
            })

            ->addColumn('transaction_code', function ($data) {
                return $data->transaction_code;
            })

            ->addColumn('Product', function ($data) {
                return $data->product->product_name;
            })
            ->addColumn('Cabang Toko', function ($data) {
                return $data->branch->name;
            })
            ->addColumn('amount', function ($data) {
                return format_currency($data->amount);
            })
            ->addColumn('payment_method', function ($data) {
                return $data->payment_method;
            })
            ->addColumn('payment_status', function ($data) {
                return $data->payment_status;
            })
            ->addColumn('customer_name', function ($data) {
                return $data->customer_name;
            })
            ->addColumn('customer_phone', function ($data) {
                return $data->customer_phone;
            })
            ->rawColumns(['transaction_image', 'action', 'Product', 'Cabang Toko', 'amount', 'payment_method', 'payment_status', 'customer_name', 'customer_phone']);
    }

    public function query(Transaction $model)
    {
        $query = $model->newQuery()->with(['product', 'branch']);
        return $query;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('transactions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(0)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('transaction_code')
                ->title('Transaction Code')
                ->className('text-center align-middle'),
            Column::make('product.product_name')
                ->title('Product')
                ->className('text-center align-middle'),
            Column::make('branch.name')
                ->title('Cabang Toko')
                ->className('text-center align-middle'),
            Column::make('amount')
                ->title('Amount')
                ->className('text-center align-middle'),
            Column::make('payment_method')
                ->title('Payment Method')
                ->className('text-center align-middle'),
            Column::make('payment_status')
                ->title('Payment Status')
                ->className('text-center align-middle'),
            Column::make('customer_name')
                ->title('Customer Name')
                ->className('text-center align-middle'),
            Column::make('customer_phone')
                ->title('Customer Phone')
                ->className('text-center align-middle'),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->className('text-center align-middle'),
            // Column::make('created_at')
            //     ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Transactions_' . date('YmdHis');
    }
}
