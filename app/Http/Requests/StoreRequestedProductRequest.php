<?php

namespace App\Http\Requests;

use App\Models\RequestedProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequestedProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('requested_product_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'quantity'   => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price'      => [
                'numeric',
                'required',
            ],
            'name'       => [
                'string',
                'required',
            ],
        ];
    }
}
