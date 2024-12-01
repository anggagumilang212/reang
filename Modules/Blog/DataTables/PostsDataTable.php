<?php

namespace Modules\Blog\DataTables;

use Modules\Blog\Entities\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)->with('categories')
            ->addColumn('action', function ($data) {
                return view('blog::posts.partials.actions', compact('data'));
            })
            ->addColumn('post_image', function ($data) {
                $url = $data->getFirstMediaUrl('images', 'thumb');
                return '<img src="' . $url . '" border="0" width="50" class="img-thumbnail" align="center"/>';
            })
            ->addColumn('description', function ($data) {
                return view('blog::posts.partials.description', [
                    'data' => $data
                ]);
            })
            ->addColumn('categories', function ($data) {
                return view('blog::posts.partials.categories-index', [
                    'data' => $data
                ]);
            })
            ->rawColumns(['post_image']);;
    }

    public function query(Post $model)
    {
        return $model->newQuery()
            ->with(['categories' => function ($query) {
                $query->select('title')->take(10)->get();
            }])
            ->when(request('status'), function ($query, $status) {
                return $query->where('status', $status);
            });
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('posts-table')
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
            Column::computed('post_image')
            ->title(__('messages.image'))
                ->width('200px')
                ->className('text-center align-middle'),

            Column::make('title')
            ->title(__('messages.title'))
                ->width('300px')
                ->className('text-center align-middle'),

            Column::make('status')
            ->title(__('messages.status'))
                ->width('100px')
                ->className('text-center align-middle'),

            Column::computed('categories')
            ->title(__('messages.category'))
                ->width('200px')
                ->sortable(false)
                ->className('text-center align-middle'),

            Column::computed('description')
            ->title(__('messages.description'))
                ->width('400px')
                ->sortable(false)
                ->className('text-center align-middle'),

            Column::computed('action')
            ->title(__('messages.action'))
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false),
        ];
    }


    protected function filename(): string
    {
        return 'Posts_' . date('YmdHis');
    }
}
