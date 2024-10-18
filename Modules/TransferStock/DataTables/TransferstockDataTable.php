<?php

namespace Modules\Transferstock\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Transferstock\Entities\Transferstock;

class TransferStockDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('transferstock::transfers.partials.actions', compact('data'));
            })
            ->addColumn('Product', function ($data) {
                return $data->product->product_name;
            })
            ->addColumn('From Branch', function ($data) {
                return $data->fromBranch ? $data->fromBranch->name : '-';
            })
            ->addColumn('To Branch', function ($data) {
                return $data->toBranch ? $data->toBranch->name : '-';
            })
            ->addColumn('Quantity', function ($data) {
                return $data->quantity;
            })
            ->addColumn('Status', function ($data) {
                return '<span class="badge bg-' . $data->status_color . '">' . $data->status . '</span>';
            })
            ->rawColumns(['action', 'Product', 'From Branch', 'To Branch', 'Status']);
    }


    public function query(Transferstock $model)
    {
        // Gunakan eager loading untuk relasi 'product', 'fromBranch', dan 'toBranch'
        return $model->newQuery()->with(['product', 'fromBranch', 'toBranch']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('transferstocks-table')
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
            // Column::make('created_at')
            //     ->title('Date')
            //     ->className('text-center align-middle')
            //     ->format(fn($value) => $value->format('d/m/Y')),
            Column::computed('From Branch') // Gunakan nama custom dari kolom di addColumn
                ->title('From Branch')
                ->searchable(true)
                ->className('text-center align-middle'),
            Column::computed('To Branch') // Gunakan nama custom dari kolom di addColumn
                ->title('To Branch')
                ->searchable(true)
                ->className('text-center align-middle'),
            Column::make('product.product_name') // Ini tetap bisa seperti sebelumnya
                ->title('Product')
                ->searchable(true)
                ->className('text-center align-middle'),
            Column::computed('quantity')
                ->title('Quantity')
                ->searchable(true)
                ->className('text-center align-middle'),
            Column::computed('status')
                ->title('Status')
                ->className('text-center align-middle')
                ->exportable(false)
                ->printable(false)
                ->searchable(true),
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle')
        ];
    }



    protected function filename(): string
    {
        return 'transferstocks_' . date('YmdHis');
    }
}
