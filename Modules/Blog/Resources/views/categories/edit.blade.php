@extends('layouts.app')

@section('title', 'Edit Post Category')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('messages.post') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('post-categories.index') }}">{{ __('messages.category') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.edit') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form id="post-categories-form" action="{{ route('post-categories.update', $post_category->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">{{ __('messages.update') }} {{ __('messages.category') }} <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                                        <input id="title" type="text" class="form-control"
                                            value="{{ old('title', $post_category->title) }}" name="title" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="slug">{{ __('messages.slug') }} <span class="text-danger">*</span></label>
                                        <input id="slug" type="text" value="{{ old('slug', $post_category->slug) }}"
                                            class="form-control" name="slug" placeholder="Auto Generated" required
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="select_category_parent">{{ __('messages.parent_category') }}</label>
                                <select id="select_category_parent" name="parent_category" class="form-control select2">
                                    <option value="">{{ __('messages.select') }} {{ __('messages.parent_category') }}</option>
                                    @foreach ($post_categories as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('parent_category', $post_category->parent_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('messages.description') }}</label>
                                <textarea name="description" id="description" rows="4 " class="form-control">{{ old('description', $post_category->description) }}</textarea>
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

                <div class="col-lg-12 pt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">{{ __('messages.image') }} <i class="bi bi-question-circle-fill text-info"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                <div class="dropzone d-flex flex-wrap align-items-center justify-content-center"
                                    id="document-dropzone">
                                    <div class="dz-message" data-dz-message>
                                        <i class="bi bi-cloud-arrow-up"></i>
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

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
@endsection

@push('page_scripts')
    <script>
        $(function() {
            // generateSlug
            function generateSlug(value) {
                return value.trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, '-')
                    .replace(/-+/g, '-').replace(/^-|-$/g, "");
            }



            // event:input title
            $('#title').change(function() {
                let title = $(this).val();
                let parent_category = $('#select_category_parent').val() ?? "";
                $('#slug').val(generateSlug(title + " " + parent_category));
            });

            // event:select parent category
            $('#select_category_parent').change(function() {
                let title = $('#title').val();
                let parent_category = $(this).val() ?? "";
                $('#slug').val(generateSlug(title + " " + parent_category));
            });
        });
    </script>

    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('dropzone.upload') }}',
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 3,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function(file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            },
            init: function() {
                @if (isset($post_category) && $post_category->getMedia('images'))
                    var files = {!! json_encode($post_category->getMedia('images')) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        this.options.thumbnail.call(this, file, file.original_url);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
                    }
                @endif
            }
        }
    </script>
@endpush
