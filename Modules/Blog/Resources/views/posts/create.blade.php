@extends('layouts.app')

@section('title', 'Create Post')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('messages.post') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.add') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="post-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">{{ __('messages.create') }} {{ __('messages.post') }} <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">{{ __('messages.title') }} <span class="text-danger">*</span></label>
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
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="select_post_tag">{{ __('messages.post_tag') }} <span class="text-danger">*</span></label>
                                        <select id="select_post_tag" name="tags[]" class="form-control select2" multiple>
                                            <option value="">{{ __('messages.select') }} {{ __('messages.post_tag') }} </option> {{-- Placeholder option --}}
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="select_post_status">{{ __('messages.status') }} <span class="text-danger">*</span></label>
                                        <select id="select_post_status" name="status" class="form-control select2">
                                            <option value="">{{ __('messages.select') }} {{ __('messages.status') }}</option> {{-- Placeholder option --}}
                                            @foreach ($statuses as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('status') == $key ? 'selected' : null }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('messages.description') }} <i class="bi bi-question-circle-fill text-info"
                                        data-toggle="tooltip" data-placement="top" title="Max 250 Characters"></i> <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="4 " class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">{{ __('messages.content') }} <span class="text-danger">*</span></label>
                                <textarea id="editor" name="content" id="content" class="form-control">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="input_post_description">{{ __('messages.category') }} <span class="text-danger">*</span></label>
                                <div class="form-control overflow-auto @error('category') is-invalid @enderror"
                                    style="height: 460px">
                                    <!-- List category -->
                                    @include('blog::posts.partials.categories', [
                                        'categories' => $categories,
                                        'categoryChecked' => old('category'),
                                        'count' => 0,
                                    ])
                                    <!-- End List category -->
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">{{ __('messages.image') }} <i class="bi bi-question-circle-fill text-info"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Max Files: 3, Max File Size: 2MB, Image Size: 1920x1080"></i></label>
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
    <script src="{{ asset('vendor/ckeditor5/build/ckeditor.js') }}"></script>
@endsection

@push('page_scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(function() {
            // event: input slug
            $("#title").change(function(event) {
                $("#slug").val(
                    event.target.value
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, "-")
                    .replace(/-+/g, "-")
                    .replace(/^-|-$/g, "")
                );
            });
        });
    </script>

    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('dropzone.upload') }}',
            maxFilesize: 2,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 3,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                $.ajax({
                    type: "POST",
                    url: "{{ route('dropzone.delete') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'file_name': `${name}`
                    },
                });
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            },
            init: function() {
                @if (isset($post) && $post->getMedia('images'))
                    var files = {!! json_encode($post->getMedia('images')) !!};
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
