<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('messages.start_date') }} <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('messages.end_date') }} <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('messages.branches') }}</label>
                                    <select wire:model="branch_id" class="form-control" name="branch_id">
                                        <option value="">{{ __('messages.select_branch') }}</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                {{ __('messages.filter_report') }}
                            </button>
                            <button type="button" wire:click="printReport" class="btn btn-success">
                                <i class="bi bi-printer"></i> {{ __('messages.print') }} {{ __('messages.reports') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex
                            class="col-12 position-absolute justify-content-center align-items-center"
                            style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">{{ __('messages.loading') }}</span>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>{{ __('messages.date') }}</th>
                                <th>{{ __('messages.details') }}</th>
                                <th>{{ __('messages.branches') }}</th>
                                <th>{{ __('messages.amount') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expenses as $expense)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}</td>
                                    <td>{{ $expense->details }}</td>
                                    <td>{{ $expense->branch->name }}</td>

                                    <td>{{ format_currency($expense->amount) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">No Expenses Data Available!</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $expenses->hasPages()])>
                        {{ $expenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printReport() {
        let reportContent = document.querySelector('.card-body').innerHTML; // Ambil bagian tabel
        let printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title>Expenses Report</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
                        th { background-color: #f4f4f4; }
                    </style>
                </head>
                <body>
                    <h1>Expenses Report</h1>
                    ${reportContent}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>
