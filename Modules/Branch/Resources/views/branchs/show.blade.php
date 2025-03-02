@extends('layouts.app')

@section('title', 'Branch Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('branchs.index') }}">Branch</a></li>
        <li class="breadcrumb-item active">Details</li>
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
                                    <th>Name</th>
                                    <td>{{ $Branch->name }}</td>
                                </tr>
                                <tr>
                                    <th>Rating</th>
                                    <td> @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $Branch->rating)
                                             <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor</td>
                                </tr>

                                <tr>
                                    <th>Content</th>
                                    <td>{{ $Branch->content }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                            <img src="{{ $Branch->getFirstMediaUrl('branch') }}" alt="Product Image"
                                class="img-fluid img-thumbnail mb-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
