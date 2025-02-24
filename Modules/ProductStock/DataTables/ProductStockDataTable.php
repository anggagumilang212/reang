<?php

namespace Modules\ProductStock\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\Branch\Entities\Branch;
use Yajra\DataTables\Services\DataTable;
use Modules\ProductStock\Entities\ProductStock;

class ProductStockDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('productstock::productstocks.partials.actions', compact('data'));
            })
            ->addColumn('Product', function ($data) {
                $productName = $data->product->product_name ?? '-';
                $productPrice = $data->product->product_price ?? 0;
                return $productName . ' - Rp ' . number_format($productPrice, 2);
            })
            ->addColumn('Cabang Toko', function ($data) {
                return $data->branch->name;
            })
            ->addColumn('Quantity', function ($data) {
                return $data->quantity;
            })
            ->filterColumn('Product', function($query, $keyword) {
                $query->whereHas('product', function($q) use ($keyword) {
                    $q->where('product_name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action', 'Product', 'Cabang Toko'])
            ->filterColumn('branch.name', function($query, $keyword) {
                $query->whereHas('branch', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            });
    }

    public function query(ProductStock $model)
    {
        $query = $model->newQuery()->with(['product', 'branch']);

        if (request()->has('branch_id') && request('branch_id') !== '') {
            $query->where('branch_id', request('branch_id'));
        }

        if (request()->has('stock_status') && request('stock_status') !== '') {
            switch(request('stock_status')) {
                case 'empty':
                    $query->where('quantity', 0);
                    break;
                case 'low':
                    $query->where('quantity', '>', 0)
                          ->where('quantity', '<=', 10);
                    break;
                case 'normal':
                    $query->where('quantity', '>', 10);
                    break;
            }
        }

        return $query;
    }

    public function html()
    {
        $branches = Branch::all()->map(function($branch) {
            return [
                'text' => $branch->name,
                'action' => "function(e, dt, node, config) {
                    dt.ajax.url(dt.ajax.url().split('?')[0] + '?branch_id=$branch->id').load();
                }"
            ];
        });

        $stockFilters = [
            [
                'text' => 'Semua Stock',
                'action' => "function(e, dt, node, config) {
                    dt.ajax.url(dt.ajax.url().split('?')[0]).load();
                }"
            ],
            [
                'text' => 'Stock Kosong',
                'action' => "function(e, dt, node, config) {
                    dt.ajax.url(dt.ajax.url().split('?')[0] + '?stock_status=empty').load();
                }"
            ],
            [
                'text' => 'Stock Menipis (1-10)',
                'action' => "function(e, dt, node, config) {
                    dt.ajax.url(dt.ajax.url().split('?')[0] + '?stock_status=low').load();
                }"
            ],
            [
                'text' => 'Stock Normal (>10)',
                'action' => "function(e, dt, node, config) {
                    dt.ajax.url(dt.ajax.url().split('?')[0] + '?stock_status=normal').load();
                }"
            ]
        ];

        return $this->builder()
            ->setTableId('productstocks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-6 mb-2'B><'col-md-3'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(0)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
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
                [
                    'extend' => 'collection',
                    'className' => 'btn btn-secondary dropdown-toggle',
                    'text' => '<i class="bi bi-box-seam"></i> Filter Stock',
                    'buttons' => $stockFilters
                ]
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('Product')
                ->title(__('messages.productname'))
                ->className('text-center align-middle'),
            Column::make('branch.name')
                ->title('Cabang Toko')
                ->className('text-center align-middle'),
            Column::computed('quantity')
                ->title(__('messages.quantity'))
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
        return 'productstocks_' . date('YmdHis');
    }
}
