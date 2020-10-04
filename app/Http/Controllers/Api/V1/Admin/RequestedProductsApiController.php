<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestedProductRequest;
use App\Http\Requests\UpdateRequestedProductRequest;
use App\Http\Resources\Admin\RequestedProductResource;
use App\Models\RequestedProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestedProductsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('requested_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestedProductResource(RequestedProduct::with(['product'])->get());
    }

    public function store(StoreRequestedProductRequest $request)
    {
        $requestedProduct = RequestedProduct::create($request->all());

        return (new RequestedProductResource($requestedProduct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RequestedProduct $requestedProduct)
    {
        abort_if(Gate::denies('requested_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestedProductResource($requestedProduct->load(['product']));
    }

    public function update(UpdateRequestedProductRequest $request, RequestedProduct $requestedProduct)
    {
        $requestedProduct->update($request->all());

        return (new RequestedProductResource($requestedProduct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RequestedProduct $requestedProduct)
    {
        abort_if(Gate::denies('requested_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestedProduct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
