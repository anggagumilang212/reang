{{-- Modules/MediaReview/Resources/views/mediareviews/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Media Review')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mediareview.index') }}">Media Reviews</a></li>
        <li class="breadcrumb-item active">{{ __('messages.create') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('mediareview.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_id">{{ __('messages.products')}} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="product_id" id="product_id" required>
                                            <option value="">{{ __('messages.select_product')}} </option>
                                            @foreach(\Modules\Product\Entities\Product::all() as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="media_type">{{ __('messages.type')}} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="type" id="media_type" required>
                                            <option value="">Select {{ __('messages.type')}} </option>
                                            <option value="image">Image</option>
                                            <option value="video">Video</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="media">{{ __('messages.upload_media')}} <i class="bi bi-question-circle-fill text-info"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Supported formats: JPEG, PNG, JPG, GIF, MP4, MOV, AVI. Max size: 10MB"></i></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('media') is-invalid @enderror"
                                                id="media" name="media" required>
                                            <label class="custom-file-label" for="media">Choose file</label>
                                            @error('media')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div id="preview-container" class="mt-3 d-none">
                                        <h6>{{ __('messages.preview')}}:</h6>
                                        <img id="image-preview" class="img-fluid d-none" style="max-height: 300px;">
                                        <video id="video-preview" class="d-none" controls style="max-height: 300px;">
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('messages.create') }} <i class="bi bi-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_css')
<style>
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }
</style>
@endpush

@push('page_scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

        // Handle file input change
        $('#media').change(function(e) {
            const file = e.target.files[0];
            const mediaType = $('#media_type').val();
            const previewContainer = $('#preview-container');
            const imagePreview = $('#image-preview');
            const videoPreview = $('#video-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewContainer.removeClass('d-none');

                    if (mediaType === 'image') {
                        imagePreview.attr('src', e.target.result);
                        imagePreview.removeClass('d-none');
                        videoPreview.addClass('d-none');
                    } else if (mediaType === 'video') {
                        videoPreview.find('source').attr('src', e.target.result);
                        videoPreview.removeClass('d-none');
                        imagePreview.addClass('d-none');
                        videoPreview[0].load();
                    }
                }

                reader.readAsDataURL(file);
            }
        });

        // Handle media type change
        $('#media_type').change(function() {
            const mediaInput = $('#media');
            mediaInput.val('');
            $('.custom-file-label').text('Choose file');
            $('#preview-container').addClass('d-none');
            $('#image-preview').addClass('d-none');
            $('#video-preview').addClass('d-none');

            // Update accepted file types
            if ($(this).val() === 'image') {
                mediaInput.attr('accept', '.jpeg,.jpg,.png,.gif');
            } else if ($(this).val() === 'video') {
                mediaInput.attr('accept', '.mp4,.mov,.avi');
            }
        });
    });
</script>
@endpush
