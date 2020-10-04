<?php

namespace App\Http\Requests;

use App\Models\RequestedProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequestedProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('requested_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:requested_products,id',
        ];
    }
}
