@extends('layouts.app')

@section('title', 'Edit Quotation')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('quotations.index') }}">{{ __('messages.quotations') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.edit') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-product />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="quotation-form" action="{{ route('quotations.update', $quotation) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">{{ __('messages.reference') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $quotation->reference }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="customer_id">{{ __('messages.customer') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="customer_id" id="customer_id" required>
                                                @foreach (\Modules\People\Entities\Customer::all() as $customer)
                                                    <option {{ $quotation->customer_id == $customer->id ? 'selected' : '' }}
                                                        value="{{ $customer->id }}">{{ $customer->customer_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="date">{{ __('messages.date') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date" required
                                                value="{{ $quotation->getAttributes()['date'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="branch_id">{{ __('messages.branches') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="branch_id" id="branch_id" required>
                                                @foreach (\Modules\Branch\Entities\Branch::all() as $branch)
                                                    <option
                                                        {{ $quotation->branch_id == $branch->id ? 'selected' : '' }}
                                                        value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <livewire:product-cart :cartInstance="'quotation'" :data="$quotation" />

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">{{ __('messages.status') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option {{ $quotation->status == 'Pending' ? 'selected' : '' }}
                                                value="Pending">Pending</option>
                                            <option {{ $quotation->status == 'Sent' ? 'selected' : '' }} value="Sent">
                                                Sent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">{{ __('messages.note') }} (If Needed)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $quotation->note }}</textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.update') }} {{ __('messages.quotations') }} <i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
@endpush
