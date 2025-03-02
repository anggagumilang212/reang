@extends('layouts.app')

@section('title', 'Banner Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('messages.home')}} </a></li>
        <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">{{__('messages.banner')}}</a></li>
        <li class="breadcrumb-item active"> {{__('messages.details')}}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-body">
                <img src="{{ $Banner->getFirstMediaUrl('banner') }}" alt="Barcode Image"   class="img-fluid img-thumbnail mb-2"/>
                </div>
            </div>
        </div>

    </div>
@endsection
