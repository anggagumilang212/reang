@extends('layouts.app')

@section('title', 'Create Banner')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">{{ __('messages.banner') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.add') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="product-form" action="{{ route('closingkasir.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        {{-- <button class="btn btn-primary">{{ __('messages.create') }} {{ __('messages.banner') }} <i
                                class="bi bi-check"></i></button> --}}
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title
                            ">Laporan Closing Kasir</h4>
                            {{-- pilih branch --}}
                            <div class="mb-3">
                                <label for="branch_id" class="form-label">Branch</label>
                                <select name="branch_id" class="form-control">
                                    <option value="">Pilih Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="selisih_manual" class="form-label">Selisih Tidak Tercatat (kosongkan jika tidak
                                    ada)</label>
                                <input type="number" step="0.01" name="selisih_manual" class="form-control">
                            </div>

                            <button class="btn btn-primary">Simpan CLosing Kasir <i class="bi bi-check"></i></button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
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

    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
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

            $('#product-form').submit(function() {
                var product_cost = $('#product_cost').maskMoney('unmasked')[0];
                var product_price = $('#product_price').maskMoney('unmasked')[0];
                $('#product_cost').val(product_cost);
                $('#product_price').val(product_price);
            });
        });
    </script>
@endpush
