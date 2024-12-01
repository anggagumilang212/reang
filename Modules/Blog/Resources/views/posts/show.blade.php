@extends('layouts.app')

@section('title', 'Post Details')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('messages.post') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @forelse($post->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $post->getFirstMediaUrl('images') }}" alt="Image"
                                class="img-fluid img-thumbnail mb-2">
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h3>{{ $post->title }}</h3>

                        <p>{{ __('messages.created_by') }}   {{ $post->user->name }} {{ __('messages.on') }}
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d F Y') }}
                        </p>

                        <p class="text-justify">
                            {{ $post->description }}
                        </p>

                        {{ __('messages.category') }} : <br>
                        @foreach ($categories as $category)
                            <span class="badge badge-primary">
                                {{ $category->title }}
                            </span>
                        @endforeach
                        <br><br>

                        <div class="py-1 text-justify">
                            {!! $post->content !!}
                        </div><br>

                        {{ __('messages.post_tag') }} : <br>
                        @foreach ($tags as $tag)
                            <span class="badge badge-info">
                                #{{ $tag->title }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
@endsection

@push('page_scripts')
@endpush
