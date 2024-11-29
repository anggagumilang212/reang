<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Expense\Entities\Expense;
use Modules\Sale\Entities\Sale;

class ExpensesReport extends Component
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
    public $totalExpenses = 0;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount($customers)
    {
        $this->customers = $customers;
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->branch_id = '';
        $this->sale_status = '';
        $this->payment_status = '';
    }

    public function render()
    {
        $query = Expense::with('branch')
            ->whereDate('date', '>=', $this->start_date)
            ->whereDate('date', '<=', $this->end_date)
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->orderBy('date', 'desc');

        // Calculate totals from the full dataset
        $totals = (clone $query)->get();
        $this->totalExpenses = $totals->sum('total_amount');
        $this->totalProfit = $totals->sum(function ($sale) {
        });

        // Get paginated results for display
        $expenses = $query->paginate(10);

        return view('livewire.reports.expenses-report', [
            'expenses' => $expenses
        ]);
    }

    public function generateReport()
    {
        // $this->validate();
        $this->render();
    }

    public function printReport()
    {
        // $this->validate();

        $expenses = Expense::with('branch')
            ->whereDate('date', '>=', $this->start_date)
            ->whereDate('date', '<=', $this->end_date)
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->orderBy('date', 'desc')
            ->get();

        return redirect()->route('expenses.print.report', [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'branch_id' => $this->branch_id,
        ]);
    }
}
