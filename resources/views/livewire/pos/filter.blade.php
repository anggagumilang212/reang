<div>
    <div class="form-row">
        <div class="col-md-7">
            <div class="form-group">
                <label>{{__('messages.products')}} {{__('messages.category')}}</label>
                <select wire:model.live="category" class="form-control">
                    <option value="">{{__('messages.all_products')}}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>{{__('messages.product_count')}}</label>
                <select wire:model.live="showCount" class="form-control">
                    <option value="9">9 {{__('messages.products')}}</option>
                    <option value="15">15 {{__('messages.products')}}</option>
                    <option value="21">21 {{__('messages.products')}}</option>
                    <option value="30">30 {{__('messages.products')}}</option>
                    <option value="">{{__('messages.all_products')}}</option>
                </select>
            </div>
        </div>
    </div>
</div>
