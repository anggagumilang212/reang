@extends('layouts.app')

@section('title', 'Create Post Tag')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('messages.post') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tags.index') }}">{{ __('messages.post_tag') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.add') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">{{ __('messages.create') }} {{ __('messages.post_tag') }} <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                                        <input id="title" type="text" class="form-control"
                                            value="{{ old('title') }}" name="title" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="slug">{{ __('messages.slug') }} <span class="text-danger">*</span></label>
                                        <input id="slug" type="text" value="{{ old('slug') }}"
                                            class="form-control" name="slug" placeholder="Auto Generated" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            // slug
            const generateSlug = (value) => {
                return value.trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, '-')
                    .replace(/-+/g, '-').replace(/^-|-$/g, "")
            }

            // event: slug
            $("#title").change(function(event) {
                $('#slug').val(generateSlug(event.target.value))
            });
        });
    </script>
@endpush
