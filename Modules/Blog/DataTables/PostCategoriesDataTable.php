<?php

namespace Modules\Blog\DataTables;

use Modules\Blog\Entities\PostCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostCategoriesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('blog::categories.partials.actions', compact('data'));
            });
    }

    public function query(PostCategory $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('post-categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> . 'tr' . <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(4)
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
            Column::make('id')->title('#')
                ->searchable(false)
                ->orderable(false)
                ->exportable(false)
                ->printable(false)
                ->width(10)
                ->className('text-center align-middle'),

            Column::make('title')
                ->title(__('messages.title'))
                ->width(10)
                ->className('text-center align-middle'),

            Column::make('slug')
            ->title(__('messages.slug'))
                ->width(10)
                ->className('text-center align-middle'),

            Column::make('description')
            ->title(__('messages.description'))
                ->width(50)
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title(__('messages.action'))
                ->exportable(false)
                ->printable(false)
                ->width(10)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false),
        ];
    }


    protected function filename(): string
    {
        return 'Tags_' . date('YmdHis');
    }
}
