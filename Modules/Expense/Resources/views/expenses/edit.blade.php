@extends('layouts.app')

@section('title', 'Create Expense')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expenses.index') }}">{{ __('messages.expenses') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.edit') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="expense-form" action="{{ route('expenses.update', $expense) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">{{ __('messages.update') }} {{ __('messages.expenses') }} <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">{{ __('messages.reference') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required value="{{ $expense->reference }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date">{{ __('messages.date') }} <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date" required value="{{ $expense->getAttributes()['date'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="branch_id">{{ __('messages.branches') }} <span class="text-danger">*</span></label>
                                        <select name="branch_id" id="branch_id" class="form-control" required>
                                            @foreach(\Modules\Branch\Entities\Branch::all() as $branch)
                                                <option {{ $branch->id == $expense->branch_id ? 'selected' : '' }} value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_id">{{ __('messages.category') }} <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            @foreach(\Modules\Expense\Entities\ExpenseCategory::all() as $category)
                                                <option {{ $category->id == $expense->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="amount">{{ __('messages.amount') }} <span class="text-danger">*</span></label>
                                        <input id="amount" type="text" class="form-control" name="amount" required value="{{ $expense->amount }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="details">{{ __('messages.details') }}</label>
                                <textarea class="form-control" rows="6" name="details">{{ $expense->details }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#amount').maskMoney({
                prefix:'{{ settings()->currency->symbol }}',
                thousands:'{{ settings()->currency->thousand_separator }}',
                decimal:'{{ settings()->currency->decimal_separator }}',
            });

            $('#amount').maskMoney('mask');

            $('#expense-form').submit(function () {
                var amount = $('#amount').maskMoney('unmasked')[0];
                $('#amount').val(amount);
            });
        });
    </script>
@endpush
