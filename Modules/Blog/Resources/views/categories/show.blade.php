@extends('layouts.app')

@section('title', 'Post Category Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('messages.post') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('post-categories.index') }}">{{ __('messages.category') }}</a></li>
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
                                    <th>{{ __('messages.title') }}</th>
                                    <td>{{ $post_category->title }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.slug') }}</th>
                                    <td>{{ $post_category->slug }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('messages.parent_category') }}</th>
                                    @if (!!$post_category->parent)
                                        <td>{{ $post_category->parent->title }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>{{ __('messages.description') }}</th>
                                    <td>{{ $post_category->description }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        @forelse($post_category->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $post_category->getFirstMediaUrl('images') }}" alt="Image"
                                class="img-fluid img-thumbnail mb-2">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
