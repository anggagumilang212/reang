<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Modules\Expense\Entities\Expense;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Entities\PurchasePayment;
use Modules\PurchasesReturn\Entities\PurchaseReturn;
use Modules\PurchasesReturn\Entities\PurchaseReturnPayment;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SalePayment;
use Modules\SalesReturn\Entities\SaleReturn;
use Modules\SalesReturn\Entities\SaleReturnPayment;
use Modules\Branch\Entities\Branch;

class ProfitLossReport extends Component
{
    public $start_date;
    public $end_date;
    public $branch_id;
    public $branches;

    public $total_sales, $sales_amount;
    public $total_purchases, $purchases_amount;
    public $total_sale_returns, $sale_returns_amount;
    public $total_purchase_returns, $purchase_returns_amount;
    public $expenses_amount;
    public $profit_amount;
    public $payments_received_amount;
    public $payments_sent_amount;
    public $payments_net_amount;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
        'branch_id'  => 'nullable|exists:branch,id'
    ];

    public function mount($branches) {
        $this->branches = $branches;
        $this->start_date = '';
        $this->end_date = '';
        $this->branch_id = '';

        // Reset all calculation fields
        $this->resetCalculationFields();
    }

    protected function resetCalculationFields() {
        $this->total_sales = 0;
        $this->sales_amount = 0;
        $this->total_sale_returns = 0;
        $this->sale_returns_amount = 0;
        $this->total_purchases = 0;
        $this->purchases_amount = 0;
        $this->total_purchase_returns = 0;
        $this->purchase_returns_amount = 0;
        $this->payments_received_amount = 0;
        $this->payments_sent_amount = 0;
        $this->payments_net_amount = 0;
        $this->expenses_amount = 0;
        $this->profit_amount = 0;
    }

    public function render() {
        return view('livewire.reports.profit-loss-report');
    }

    public function generateReport() {
        $this->validate();
        $this->setValues();
    }

    protected function applyDateAndBranchFilters($query) {
        return $query->when($this->start_date, function ($q) {
                return $q->whereDate('date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($q) {
                return $q->whereDate('date', '<=', $this->end_date);
            })
            ->when($this->branch_id, function ($q) {
                return $q->where('branch_id', $this->branch_id);
            });
    }

    public function setValues() {
        // Reset fields before calculation
        $this->resetCalculationFields();

        // Sales
        $this->total_sales = $this->applyDateAndBranchFilters(Sale::completed())->count();
        $this->sales_amount = $this->applyDateAndBranchFilters(Sale::completed())->sum('total_amount') / 100;

        // Purchases
        $this->total_purchases = $this->applyDateAndBranchFilters(Purchase::completed())->count();
        $this->purchases_amount = $this->applyDateAndBranchFilters(Purchase::completed())->sum('total_amount') / 100;

        // Sale Returns
        $this->total_sale_returns = $this->applyDateAndBranchFilters(SaleReturn::completed())->count();
        $this->sale_returns_amount = $this->applyDateAndBranchFilters(SaleReturn::completed())->sum('total_amount') / 100;

        // Purchase Returns
        $this->total_purchase_returns = $this->applyDateAndBranchFilters(PurchaseReturn::completed())->count();
        $this->purchase_returns_amount = $this->applyDateAndBranchFilters(PurchaseReturn::completed())->sum('total_amount') / 100;

        // Expenses
        $this->expenses_amount = Expense::when($this->start_date, function ($query) {
                return $query->whereDate('date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                return $query->whereDate('date', '<=', $this->end_date);
            })
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->sum('amount') / 100;

        // Profit Calculation
        $this->profit_amount = $this->calculateProfit();

        // Payments
        $this->payments_received_amount = $this->calculatePaymentsReceived();
        $this->payments_sent_amount = $this->calculatePaymentsSent();
        $this->payments_net_amount = $this->payments_received_amount - $this->payments_sent_amount;
    }

    public function calculateProfit() {
        $product_costs = 0;
        $revenue = $this->sales_amount - $this->sale_returns_amount;

        $sales = $this->applyDateAndBranchFilters(Sale::completed())
            ->with('saleDetails')
            ->get();

        foreach ($sales as $sale) {
            foreach ($sale->saleDetails as $saleDetail) {
                $product_costs += $saleDetail->product->product_cost ?? '0';
            }
        }

        $profit = $revenue - $product_costs;

        return $profit;
    }

    public function calculatePaymentsReceived() {
        $sale_payments = SalePayment::when($this->start_date, function ($query) {
                return $query->whereDate('date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                return $query->whereDate('date', '<=', $this->end_date);
            })
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->sum('amount') / 100;

        $purchase_return_payments = PurchaseReturnPayment::when($this->start_date, function ($query) {
                return $query->whereDate('date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                return $query->whereDate('date', '<=', $this->end_date);
            })
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->sum('amount') / 100;

        return $sale_payments + $purchase_return_payments;
    }

    public function calculatePaymentsSent() {
        $purchase_payments = PurchasePayment::when($this->start_date, function ($query) {
                return $query->whereDate('date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                return $query->whereDate('date', '<=', $this->end_date);
            })
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->sum('amount') / 100;

        $sale_return_payments = SaleReturnPayment::when($this->start_date, function ($query) {
                return $query->whereDate('date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                return $query->whereDate('date', '<=', $this->end_date);
            })
            ->when($this->branch_id, function ($query) {
                return $query->where('branch_id', $this->branch_id);
            })
            ->sum('amount') / 100;

        return $purchase_payments + $sale_return_payments + $this->expenses_amount;
    }
}
