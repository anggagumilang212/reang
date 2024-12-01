@extends('layouts.app')

@section('title', 'Posts')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.post') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                    {{ __('messages.add') }} {{ __('messages.post') }} <i class="bi bi-plus"></i>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <form action="" method="GET">
                                    <div class="input-group mx-1">
                                        <label class="font-weight-bold mr-3 mt-1">{{ __('messages.status') }}</label>
                                        <select name="status" class="custom-select">
                                            <option value="">{{ __('messages.all') }}</option>
                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ $statusSelected == $value ? 'selected' : null }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">{{ __('messages.apply') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
