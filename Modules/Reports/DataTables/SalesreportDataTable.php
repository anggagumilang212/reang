<?php

namespace Modules\Reports\DataTables;

use Modules\Sale\Entities\Sale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\Branch\Entities\Branch;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesreportDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('Cabang Toko', function ($data) {
                return $data->branch->name;
            })
            ->addColumn('total_amount', function ($data) {
                return format_currency($data->total_amount);
            })
            ->addColumn('paid_amount', function ($data) {
                return format_currency($data->paid_amount);
            })
            ->addColumn('due_amount', function ($data) {
                return format_currency($data->due_amount);
            })

            ->addColumn('status', function ($data) {
                return view('sale::partials.status', compact('data'));
            })
            ->addColumn('payment_status', function ($data) {
                return view('sale::partials.payment-status', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('sale::partials.actions', compact('data'));
            });
    }

    public function query(Sale $model)
    {
        $query = $model->newQuery()->with(['branch']);

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
            ->setTableId('sales-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(8)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                // Button::make('reset')
                //     ->text('<i class="bi bi-x-circle"></i> Reset'),
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
                ]
            );
    }

    protected function getColumns()
    {
        return [
            // Column::make('reference')
            //     ->className('text-center align-middle'),

            Column::make('branch.name')
                ->title('Cabang Toko')
                ->className('text-center align-middle'),

            Column::make('customer_name')
                ->title('Customer')
                ->className('text-center align-middle'),

            Column::computed('status')
                ->className('text-center align-middle'),

            Column::computed('total_amount')
                ->className('text-center align-middle'),

            Column::computed('paid_amount')
                ->className('text-center align-middle'),

            Column::computed('due_amount')
                ->className('text-center align-middle'),

            Column::computed('payment_status')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Sales_' . date('YmdHis');
    }
}
