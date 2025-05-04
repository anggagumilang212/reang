<div>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
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

                <div class="form-group">
                    <label for="customer_id">{{ __('messages.customer') }} <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i>
                            </a>
                        </div>
                        <select wire:model.live="customer_id" id="customer_id" class="form-control">
                            <option value="" selected>{{ __('messages.select_customer') }}</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th class="align-middle">{{ __('messages.products') }}</th>
                                <th class="align-middle">{{ __('messages.price') }}</th>
                                <th class="align-middle">{{ __('messages.quantity') }}</th>
                                <th class="align-middle">{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cart_items->isNotEmpty())
                                @foreach ($cart_items as $cart_item)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $cart_item->name }} <br>
                                            <span class="badge badge-success">{{ $cart_item->options->code }}</span>
                                            @include('livewire.includes.product-cart-modal')
                                        </td>
                                        <td class="align-middle">{{ format_currency($cart_item->price) }}</td>
                                        <td class="align-middle">@include('livewire.includes.product-cart-quantity')</td>
                                        <td class="align-middle text-center">
                                            <a href="#"
                                                wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                                <i class="bi bi-x-circle font-2xl text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <span class="text-danger">Please {{ __('messages.search') }} &
                                            {{ __('messages.select_product') }}!</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('messages.order_tax') }} ({{ $global_tax }}%)</th>
                                <td>(+) {{ format_currency(Cart::instance($cart_instance)->tax()) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('messages.discount') }} ({{ $global_discount }}%)</th>
                                <td>(-) {{ format_currency(Cart::instance($cart_instance)->discount()) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('messages.shipping') }}</th>
                                <input type="hidden" value="{{ $shipping }}" name="shipping_amount">
                                <td>(+) {{ format_currency($shipping) }}</td>
                            </tr>
                            <tr class="text-primary">
                                <th>{{ __('messages.grand_total') }}</th>
                                @php
                                    $total_with_shipping = Cart::instance($cart_instance)->total() + (float) $shipping;
                                @endphp
                                <th>(=) {{ format_currency($total_with_shipping) }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tax_percentage">{{ __('messages.order_tax') }} (%)</label>
                        <input wire:model.blur="global_tax" type="number" class="form-control" min="0"
                            max="100" value="{{ $global_tax }}" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="discount_percentage">{{ __('messages.discount') }} (%)</label>
                        <input wire:model.blur="global_discount" type="number" class="form-control" min="0"
                            max="100" value="{{ $global_discount }}" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="shipping_amount">{{ __('messages.shipping') }}</label>
                        <input wire:model.blur="shipping" type="number" class="form-control" min="0"
                            value="0" required step="0.01">
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="form-group d-flex justify-content-center flex-wrap mb-0">
                <button wire:click="resetCart" type="button" class="btn btn-pill btn-danger mr-3">
                    <i class="bi bi-x"></i> {{ __('messages.reset') }}
                </button>
                <button wire:loading.attr="disabled" wire:click="$set('show_checkout_form', true)" type="button"
                    class="btn btn-pill btn-primary" {{ $total_amount == 0 ? 'disabled' : '' }}>
                    <i class="bi bi-check"></i> {{ __('messages.proceed') }}
                </button>
            </div>

            {{-- Form Checkout (ditampilkan tanpa modal) --}}
            @if ($show_checkout_form)
                {{-- <form wire:submit.prevent="submitCheckout">
                    @csrf
                    <div class="modal-body">
                        @if (session()->has('checkout_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    <span>{{ session('checkout_message') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12">

                                <!-- Gunakan wire:model untuk hidden input -->
                                <input type="hidden" wire:model="customer_id" name="customer_id">
                                <input type="hidden" wire:model="tax_percentage" name="tax_percentage">
                                <input type="hidden" wire:model="discount_percentage" name="discount_percentage">
                                <input type="hidden" wire:model="shipping_amount" name="shipping_amount">

                                <div class="form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="total_amount">{{ __('messages.totalamount') }} <span
                                                    class="text-danger">*</span></label>
                                            <input id="total_amount" type="text" class="form-control"
                                                name="total_amount" wire:model.defer="total_amount" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="paid_amount">{{ __('messages.paidamount') }} <span
                                                    class="text-danger">*</span></label>
                                            <input id="paid_amount" type="text" class="form-control"
                                                name="paid_amount" wire:model.defer="paid_amount" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="payment_method">{{ __('messages.paymentmethod') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" wire:model.defer="payment_method"
                                        id="payment_method" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="note">{{ __('messages.note') }}
                                        ({{ __('messages.optional') }})</label>
                                    <textarea name="note" id="note" rows="5" class="form-control" wire:model.defer="note"></textarea>
                                </div>
                            </div>

                            <!-- Tabel ringkasan -->
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('messages.total') }} {{ __('messages.products') }}</th>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ Cart::instance($cart_instance)->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.order_tax') }} ({{ $global_tax }}%)</th>
                                            <td>(+) {{ format_currency(Cart::instance($cart_instance)->tax()) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.discount') }} ({{ $global_discount }}%)</th>
                                            <td>(-) {{ format_currency(Cart::instance($cart_instance)->discount()) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.shipping') }}</th>
                                            <td>(+) {{ format_currency($shipping) }}</td>
                                        </tr>
                                        <tr class="text-primary">
                                            <th>{{ __('messages.grand_total') }}</th>
                                            @php
                                                $total_with_shipping =
                                                    Cart::instance($cart_instance)->total() + (float) $shipping;
                                            @endphp
                                            <th>(=) {{ format_currency($total_with_shipping) }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="btn btn-primary">{{ __('messages.submit') }}</button>
                    </div>
                </form> --}}

                <form id="checkout-form" action="{{ route('app.pos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if (session()->has('checkout_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    <span>{{ session('checkout_message') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" value="{{ $customer_id }}" name="customer_id">
                                <input type="hidden" value="{{ $global_tax }}" name="tax_percentage">
                                <input type="hidden" value="{{ $global_discount }}" name="discount_percentage">
                                <input type="hidden" value="{{ $shipping }}" name="shipping_amount">
                                <div class="form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="total_amount">{{ __('messages.totalamount') }} <span
                                                    class="text-danger">*</span></label>
                                            {{-- <input id="total_amount" type="text" class="form-control" name="total_amount"
                                                value="0" wire:model="total_amount" readonly required> --}}
                                            <input id="total_amount" type="text" class="form-control"
                                                name="total_amount" wire:model.defer="total_amount" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="paid_amount">{{ __('messages.paidamount') }} <span
                                                    class="text-danger">*</span></label>
                                            <input id="paid_amount" type="text" class="form-control"
                                                name="paid_amount" wire:model="total_amount" value="0" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">{{ __('messages.paymentmethod') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="payment_method" id="payment_method" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="note">{{ __('messages.note') }}
                                        ({{ __('messages.optional') }})</label>
                                    <textarea name="note" id="note" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('messages.total') }} {{ __('messages.products') }}</th>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ Cart::instance($cart_instance)->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.order_tax') }} ({{ $global_tax }}%)</th>
                                            <td>(+) {{ format_currency(Cart::instance($cart_instance)->tax()) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.discount') }} ({{ $global_discount }}%)</th>
                                            <td>(-) {{ format_currency(Cart::instance($cart_instance)->discount()) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.shipping') }}</th>
                                            <input type="hidden" value="{{ $shipping }}"
                                                name="shipping_amount">
                                            <td>(+) {{ format_currency($shipping) }}</td>
                                        </tr>
                                        <tr class="text-primary">
                                            <th>{{ __('messages.grand_total') }}</th>
                                            @php
                                                $total_with_shipping =
                                                    Cart::instance($cart_instance)->total() + (float) $shipping;
                                            @endphp
                                            <th>
                                                (=) {{ format_currency($total_with_shipping) }}
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-primary"
                            id="submit-btn">{{ __('messages.submit') }}</button>

                    </div>
                </form>
            @endif

        </div>
    </div>
</div>
<script>
    document.getElementById('checkout-form').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerText = 'Processing...'; // opsional, ubah teks saat sedang diproses
    });
</script>
