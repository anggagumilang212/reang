@extends('layouts.app')

@section('title', 'Edit Post')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="post-form" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Update Post <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input id="title" type="text" class="form-control"
                                            value="{{ old('title', $post->title) }}" name="title" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input id="slug" type="text" value="{{ old('slug', $post->slug) }}"
                                            class="form-control" name="slug" placeholder="Auto Generated" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="select_post_tag">Tag <span class="text-danger">*</span></label>
                                        <select id="select_post_tag" name="tags[]" class="form-control select2" multiple>
                                            <option value="">Select Tag</option> {{-- Placeholder option --}}
                                            @foreach (old('tag', $post->tags) as $tag)
                                                <option value="{{ $tag->id }}" selected>
                                                    {{ $tag->title }}
                                                </option>
                                            @endforeach
                                            {{-- Menampilkan tag yang tersedia sebagai opsi --}}
                                            @foreach ($tags as $tag)
                                                @if (!in_array($tag->id, old('tag', $post->tags->pluck('id')->all()) ?? []))
                                                    <option value="{{ $tag->id }}">
                                                        {{ $tag->title }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="select_post_status">Status <span class="text-danger">*</span></label>
                                        <select id="select_post_status" name="status" class="form-control select2">
                                            <option value="">Select Status</option> {{-- Placeholder option --}}
                                            @foreach ($statuses as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('status', $post->status) == $key ? 'selected' : null }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="description">Description <i class="bi bi-question-circle-fill text-info"
                                        data-toggle="tooltip" data-placement="top" title="Max 250 Characters"></i> <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="4 " class="form-control">{{ old('description', $post->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea id="editor" name="content" id="content" class="form-control">
                                    {{ old('content', $post->content) }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="input_post_description">Category <span class="text-danger">*</span></label>
                                <div class="form-control overflow-auto @error('category') is-invalid @enderror"
                                    style="height: 460px">
                                    <!-- List category -->
                                    @include('blog::posts.partials.categories', [
                                        'categories' => $categories,
                                        'categoryChecked' => $post->categories->pluck('id')->toArray(),
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
                                <label for="image">Image <i class="bi bi-question-circle-fill text-info"
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
