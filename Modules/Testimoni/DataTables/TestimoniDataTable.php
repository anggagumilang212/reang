<?php

namespace Modules\Testimoni\DataTables;

use Modules\Testimoni\Entities\Testimoni;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TestimoniDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('Testimoni::testimonis.partials.actions', compact('data'));
            })
            ->addColumn('testimoni_image', function ($data) {
                if ($data->hasMedia('testimoni')) {
                    $url = $data->getFirstMediaUrl('testimoni', 'thumb');
                    return '<img src="' . $url . '" class="img-thumbnail" width="50" height="50" alt="Testimoni Image">';
                }
                return '<span class="badge bg-secondary">No Image</span>';
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('rating', function ($data) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $data->rating) {
                        $stars .= '<i class="fas fa-star text-warning"></i>';
                    } else {
                        $stars .= '<i class="far fa-star text-warning"></i>';
                    }
                }
                return $stars;
            })
            ->addColumn('content', function ($data) {
                return $data->content;
            })
            ->rawColumns(['testimoni_image', 'action', 'name', 'rating']);
    }

    public function query(Testimoni $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('testimonis-table')
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
            Column::computed('testimoni_image')
                ->title(__('messages.image'))
                ->className('text-center align-middle'),
            Column::make('name')
                ->title(__('messages.name'))
                ->className('text-center align-middle'),
            Column::make('content')
                ->title(__('messages.content'))
                ->className('text-center align-middle'),
            Column::computed('rating')
                ->title(__('messages.rating'))
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
        return 'Testimonis_' . date('YmdHis');
    }
}
