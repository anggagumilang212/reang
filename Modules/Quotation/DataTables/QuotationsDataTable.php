<?php

namespace Modules\Quotation\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\Branch\Entities\Branch;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Modules\Quotation\Entities\Quotation;

class QuotationsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('product_names', function ($data) {
                // Mengambil nama produk dari sale_details dan menggabungkannya
                return $data->quotationDetails->map(function ($detail) {
                    return $detail->product->product_name ?? '';
                })->implode(', ');
            })
            ->addColumn('Cabang Toko', function ($data) {
                return $data->branch->name ?? '';
            })
            ->addColumn('total_amount', function ($data) {
                return format_currency($data->total_amount);
            })
            ->addColumn('status', function ($data) {
                return view('quotation::partials.status', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('quotation::partials.actions', compact('data'));
            });
    }

    public function query(Quotation $model)
    {
        $query = $model->newQuery()->with(['branch', 'quotationDetails.product'])->orderBy('created_at', 'desc');;
        // Filter berdasarkan branch_id
        if (request()->has('branch_id') && request('branch_id') !== '') {
            $query->where('branch_id', request('branch_id'));
        }
        return $query;
    }

    public function html()
    {
        $branches = Branch::all()->map(function ($branch) {
            return [
                'text' => $branch->name,
                'action' => "function(e, dt, node, config) {
                    dt.ajax.url(dt.ajax.url().split('?')[0] + '?branch_id=$branch->id').load();
                }"
            ];
        });

        return $this->builder()
            ->setTableId('purchases-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-7 mb-2'B><'col-md-2'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(8)
            ->buttons(
                // Button::make('excel')
                //     ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel')
                    ->action('function(e, dt, button, config) {
        window.location.href = "/export-sales-excel";
    }'),

                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload'),
                [
                    'extend' => 'collection',
                    'className' => 'btn btn-secondary dropdown-toggle',
                    'text' => '<i class="bi bi-shop-window"></i> Filter Cabang',
                    'buttons' => array_merge(
                        [[
                            'text' => 'Semua Cabang',
                            'action' => 'function(e, dt, node, config) {
                                    dt.ajax.url(dt.ajax.url().split("?")[0]).load();
                                }'
                        ]],
                        $branches->toArray()
                    )
                ],
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('product_names')
                ->title(__('messages.productname'))
                ->className('text-center align-middle'),
            Column::make('branch.name')
                ->title(__('messages.branches'))
                ->className('text-center align-middle'),
            Column::make('date')
                ->title(__('messages.date'))
                ->className('text-center align-middle'),

            Column::make('reference')
                ->title(__('messages.reference'))
                ->className('text-center align-middle'),

            Column::make('customer_name')
                ->title(__('messages.customername'))
                ->className('text-center align-middle'),

            Column::computed('status')
                ->title(__('messages.status'))
                ->className('text-center align-middle'),

            Column::computed('total_amount')
                ->title(__('messages.totalamount'))
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title(__('messages.action'))
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Quotations_' . date('YmdHis');
    }
}
