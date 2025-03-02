<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Sale\Entities\Sale;

class SalesReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $customers;
    public $start_date;
    public $end_date;
    public $branch_id;
    public $sale_status;
    public $payment_status;
    public $totalProfit = 0;
    public $totalSales = 0;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount($customers) {
        $this->customers = $customers;
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->branch_id = '';
        $this->sale_status = '';
        $this->payment_status = '';
    }

    public function render() {
        $query = Sale::with('saleDetails')
            ->whereDate('date', '>=', $this->start_date)
            ->whereDate('date', '<=', $this->end_date)
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->when($this->sale_status, function ($query) {
                return $query->where('status', $this->sale_status);
            })
            ->when($this->payment_status, function ($query) {
                return $query->where('payment_status', $this->payment_status);
            })
            ->orderBy('date', 'desc');

        // Calculate totals from the full dataset
        $totals = (clone $query)->get();
        $this->totalSales = $totals->sum('total_amount');
        $this->totalProfit = $totals->sum(function ($sale) {
            return $sale->saleDetails->sum(function ($detail) {
                // Menambahkan null coalescing operator untuk menangani cost yang null
                $cost = $detail->product?->cost ?? 0;
                return ($detail->price - $cost) * $detail->quantity;
            });
        });

        // Get paginated results for display
        $sales = $query->paginate(10);    

        return view('livewire.reports.sales-report', [
            'sales' => $sales
        ]);
    }

    public function generateReport() {
        // $this->validate();
        $this->render();
    }

    public function printReport() {
        // $this->validate();

        $sales = Sale::with('saleDetails', 'branch')
            ->whereDate('date', '>=', $this->start_date)
            ->whereDate('date', '<=', $this->end_date)
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->when($this->sale_status, function ($query) {
                return $query->where('status', $this->sale_status);
            })
            ->when($this->payment_status, function ($query) {
                return $query->where('payment_status', $this->payment_status);
            })
            ->orderBy('date', 'desc')
            ->get();

        return redirect()->route('sales.print.report', [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'branch_id' => $this->branch_id,
            'sale_status' => $this->sale_status,
            'payment_status' => $this->payment_status
        ]);
    }
}
