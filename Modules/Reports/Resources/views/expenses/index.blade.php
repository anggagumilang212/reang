@extends('layouts.app')

@section('title', 'Expenses Report')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.expenses_report') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.expenses-report :customers="\Modules\Branch\Entities\Branch::all()"/>
        {{-- <div class="table-responsive">
            {!! $dataTable->table() !!}
        </div> --}}
    </div>
@endsection
