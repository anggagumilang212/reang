<div>
    @if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <span>{{ session('message') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif

    <!-- Existing Search Component -->
    <div class="position-relative">
        <!-- ... (your existing search component code) ... -->
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr class="align-middle">
                            <th class="align-middle">{{ __('messages.productname') }}</th>
                            <th class="align-middle">{{ __('messages.code') }}</th>
                            <th class="align-middle">
                                {{ __('messages.quantity') }} <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip"
                                    data-placement="top" title="Max Quantity: 100"></i>
                            </th>
                            <th class="align-middle">{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($selectedProducts as $index => $product)
                            <tr>
                                <td class="align-middle">{{ $product->product_name }}</td>
                                <td class="align-middle">{{ $product->product_code }}</td>
                                <td class="align-middle text-center" style="width: 200px;">
                                    <input wire:model.live="quantities.{{ $index }}" class="form-control"
                                        type="number" min="1" max="100" value="{{ $quantities[$index] }}">
                                </td>
                                <td class="align-middle text-center">
                                    @if ($product->is_barcode_generated)
                                        <span class="text-success">Barcode Generated</span>
                                    @else
                                        <button wire:click="removeProduct({{ $index }})"
                                            class="btn btn-sm btn-danger">
                                            Remove
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="text-danger">No products selected. Please search and select products
                                        above!</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button wire:click="generateBarcodes" type="button" class="btn btn-primary"
                    @if (empty($selectedProducts)) disabled @endif>
                    <i class="bi bi-upc-scan"></i> Generate Barcodes
                </button>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="generateBarcodes" class="w-100">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    @if (!empty($barcodes))
        <div class="text-right mb-3">
            <button wire:click="getPdf" wire:loading.attr="disabled" type="button" class="btn btn-primary">
                <span wire:loading wire:target="getPdf" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                <i wire:loading.remove wire:target="getPdf" class="bi bi-file-earmark-pdf"></i> Download PDF
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($barcodes as $productId => $productBarcodes)
                        @php $product = collect($selectedProducts)->firstWhere('id', $productId); @endphp
                        @foreach ($productBarcodes as $barcode)
                            <div class="col-lg-3 col-md-4 col-sm-6"
                                style="border: 1px solid #ffffff;border-style: dashed;background-color: #48FCFE;">
                                <p class="mt-3 mb-1" style="font-size: 15px;color: #000;">
                                    {{ $product->product_name ?? "" }}
                                </p>
                                <div>
                                    {{-- {!! $barcode !!} --}}
                                    <img src="{{ $barcode }}">
                                </div>
                                <p style="font-size: 15px;color: #000;">
                                    Harga: {{ format_currency($product->product_price ?? 0) }}

                                </p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
