<?php

namespace Modules\Banner\DataTables;

use Modules\Banner\Entities\Banner;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BannerDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('Banner::banners.partials.actions', compact('data'));
            })
            ->addColumn('banner_image', function ($data) {
                if ($data->hasMedia('banner')) {
                    $url = $data->getFirstMediaUrl('banner', 'thumb');
                    return '<img src="' . $url . '" class="img-thumbnail" width="50" height="50" alt="Banner Image">';
                }
                return '<span class="badge bg-secondary">No Image</span>';
            })
            // ->addColumn('status', function ($data) {
            //     return $data->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            // })
            ->rawColumns(['banner_image', 'action', 'status']);
    }

    public function query(Banner $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('banners-table')
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
            Column::computed('banner_image')
                ->title('Image')
                ->className('text-center align-middle'),

            // Column::computed('status')
            //     ->className('text-center align-middle'),
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
        return 'Banners_' . date('YmdHis');
    }
}
