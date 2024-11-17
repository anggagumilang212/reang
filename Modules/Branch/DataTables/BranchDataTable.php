<?php

namespace Modules\Branch\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Branch\Entities\Branch;

class BranchDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('branch::branchs.partials.actions', compact('data'));
            })
            ->addColumn('Name', function ($data) {
                return $data->name;
            })
            ->addColumn('Address', function ($data) {
                return $data->address;
            })
            ->addColumn('Phone', function ($data) {
                return $data->phone;
            })
            ->rawColumns(['action', 'Name', 'Address', 'Phone']);
    }


    public function query(Branch $model)
    {
        // Gunakan eager loading untuk relasi 'product' dan 'branch'
        return $model->newQuery();
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('branchs-table')
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
            Column::make('name')
                ->title(__('messages.branches'))
                ->className('text-center align-middle'),
            Column::make('address')
                ->title(__('messages.address'))
                ->className('text-center align-middle'),
            Column::computed('phone')
            ->title(__('messages.phone'))
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
        return 'branchs_' . date('YmdHis');
    }
}
