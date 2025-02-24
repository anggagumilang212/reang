<?php

namespace Modules\MediaReview\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\Branch\Entities\Branch;
use Yajra\DataTables\Services\DataTable;
use Modules\MediaReview\Entities\ProductMediaReview;

class MediaReviewDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('mediareview::mediareviews.partials.actions', compact('data'));
            })
            ->addColumn('Product', function ($data) {
                return $data->product->product_name ?? '-';
            })
            ->addColumn('Type', function ($data) {
                return $data->type;
            })
            ->addColumn('Media', function ($data) {
                // Preview media berdasarkan tipe
                if ($data->type == 'image') {
                    return '<img src="' . asset('storage/' . $data->media_path) . '" style="max-width:100px; max-height:100px;">';
                } elseif ($data->type == 'video') {
                    return '<video width="150" height="100" controls>
                        <source src="' . asset('storage/' . $data->media_path) . '" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>';
                }
                return $data->media_path;
            })
            ->rawColumns(['action', 'Product', 'Type', 'Media']);
    }


    public function query(ProductMediaReview $model)
    {
        return $model->newQuery()->with('product');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('mediareview-table')
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
            Column::make('product.product_name')
                ->title(__('messages.products'))
                ->className('text-center align-middle'),
            Column::make('type')
                ->title(__('messages.type'))
                ->className('text-center align-middle'),
            Column::computed('Media')
            ->title(__('messages.media'))
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
        return 'mediareview_' . date('YmdHis');
    }
}
