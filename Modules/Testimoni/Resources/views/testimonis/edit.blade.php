@extends('layouts.app')

@section('title', 'Edit Testimoni')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('messages.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testimonis.index') }}">{{__('messages.testimoni')}}</a></li>
        <li class="breadcrumb-item active">{{__('messages.edit')}}</li>
    </ol>
@endsection
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        width: 25px;
        height: 25px;
        margin: 0;
        padding: 0;
    }

    .rating label i {
        color: #ddd;
    }

    .rating input:checked~label i {
        color: #ffd700;
    }
</style>
@section('content')
    <div class="container-fluid mb-4">
        <form id="product-form" action="{{ route('testimonis.update', $Testimoni->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">{{__('messages.update')}} {{__('messages.testimoni')}}  <i class="bi bi-check"></i></button>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('messages.name')}} <span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control" name="name" required
                                    value="{{ $Testimoni->name }}">
                            </div>
                            <div class="form-group">
                                <label for="content">{{__('messages.content')}} <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" rows="4 " class="form-control">{{ $Testimoni->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">{{__('messages.rating')}} <span class="text-danger">*</span></label>
                                <div class="rating">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating"
                                            value="{{ $i }}"
                                            {{ old('rating', $Testimoni->rating) == $i ? 'checked' : '' }}>
                                        <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                    @endfor
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">{{__('messages.image')}}  <i class="bi bi-question-circle-fill text-info"
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
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            // event: input slug
            $("#product_name").change(function(event) {
                $("#product_slug").val(
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
                @if (isset($product) && $product->getMedia('images'))
                    var files = {!! json_encode($product->getMedia('images')) !!};
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

    <script>
        $(document).ready(function() {
            $('#product_cost').maskMoney({
                prefix: '{{ settings()->currency->symbol }}',
                thousands: '{{ settings()->currency->thousand_separator }}',
                decimal: '{{ settings()->currency->decimal_separator }}',
            });
            $('#product_price').maskMoney({
                prefix: '{{ settings()->currency->symbol }}',
                thousands: '{{ settings()->currency->thousand_separator }}',
                decimal: '{{ settings()->currency->decimal_separator }}',
            });

            $('#product_cost').maskMoney('mask');
            $('#product_price').maskMoney('mask');

            $('#product-form').submit(function() {
                var product_cost = $('#product_cost').maskMoney('unmasked')[0];
                var product_price = $('#product_price').maskMoney('unmasked')[0];
                $('#product_cost').val(product_cost);
                $('#product_price').val(product_price);
            });
        });
    </script>
@endpush
