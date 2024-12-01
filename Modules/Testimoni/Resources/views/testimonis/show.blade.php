@extends('layouts.app')

@section('title', 'Testimoni Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testimonis.index') }}">{{ __('messages.testimoni') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>{{ __('messages.name') }}</th>
                                    <td>{{ $Testimoni->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.rating') }}</th>
                                    <td> @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $Testimoni->rating)
                                             <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor</td>
                                </tr>

                                <tr>
                                    <th>{{ __('messages.content') }}</th>
                                    <td>{{ $Testimoni->content }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                            <img src="{{ $Testimoni->getFirstMediaUrl('testimoni') }}" alt="Product Image"
                                class="img-fluid img-thumbnail mb-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
