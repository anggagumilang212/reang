<?php

namespace Modules\ProductStock\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductStockRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'product_id' => ['required'],
            'branch_id' => ['required'],
            'quantity' => ['required'],
            // Validasi kombinasi unik antara product_id dan branch_id
            'product_id' => [
                'required',
                Rule::unique('productstock')->where(function ($query) {
                    return $query->where('branch_id', request('branch_id'));
                })
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('access_product_stock');
    }
}
