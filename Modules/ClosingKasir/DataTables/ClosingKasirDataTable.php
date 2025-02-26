<?php

namespace Modules\ClosingKasir\DataTables;

use Modules\ClosingKasir\Entities\ClosingKasir;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClosingKasirDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('ClosingKasir::closingkasirs.partials.actions', compact('data'));
            })
            ->addColumn('tanggal', function ($data) {
                return \Carbon\Carbon::parse($data->tanggal)->format('d M Y');
            })
            ->addColumn('total_penjualan', function ($data) {
                return format_currency($data->total_penjualan);
            })
            ->addColumn('total_pengeluaran', function ($data) {
                return format_currency($data->total_pengeluaran);
            })
            ->addColumn('selisih_manual', function ($data) {
                return format_currency($data->selisih_manual);
            })

            ->addColumn('total_setoran', function ($data) {
                return format_currency($data->total_setoran);
            })

            ->rawColumns(['action']);
    }

    public function query(ClosingKasir $model)
    {
        return $model->newQuery()->with('branch')->orderBy('created_at', 'desc');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('closingkasir-table')
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
            Column::make('branch.name')
                ->title(__('messages.branches'))
                ->className('text-center align-middle'),
            Column::computed('tanggal')
                ->title(__('messages.date'))
                ->className('text-center align-middle'),
            Column::computed('total_penjualan')
                ->title('Total Penjualan')
                ->className('text-center align-middle'),
            Column::computed('total_pengeluaran')
                ->title('Total Pengeluaran')
                ->className('text-center align-middle'),
            Column::computed('selisih_manual')
                ->title('Selisih Tidak Tercatat')
                ->className('text-center align-middle'),
            Column::computed('total_setoran')
                ->title('Total Di Setorkan')
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
        return 'LaporanClosingKasir_' . date('YmdHis');
    }
}
