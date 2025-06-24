<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected CommonHelpers $commonHelper;
    protected ProductService $productService;

    public function __construct(CommonHelpers $commonHelper,ProductService $productService)
    {
        $this->commonHelper = $commonHelper;
        $this->productService = $productService;
    }
    public function index(Request $request): JsonResponse
    {
        $products = $this->productService->index();
        $resource = ProductResource::collection($products)->toArray($request);

        return $this->commonHelper->returnResponse("Barcha mahsulotlar", $resource);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->store($request);
        return $this->commonHelper->returnResponse(
            "Mahsulot qo‘shildi",
            (new ProductResource($product))->toArray(request()),
            201
        );

    }

    public function show(string $id): JsonResponse
    {
        $product = $this->productService->show($id);
        return $this->commonHelper->returnResponse("Mahsulot", (new ProductResource($product))->toArray(request()));

    }

    public function update(UpdateProductRequest $request, string $id): JsonResponse
    {
        $product = $this->productService->update($request, $id);

        return $this->commonHelper->returnResponse("Mahsulot yangilandi", (new ProductResource($product))->toArray(request()));
    }


    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $this->productService->destroy($product);
        return $this->commonHelper->returnResponse("Mahsulot o‘chirildi");
    }


}
