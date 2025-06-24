<?php

namespace App\Services;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Helpers\CommonHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductService
{
    protected CommonHelpers $commonHelper;

    public function __construct(CommonHelpers $commonHelper)
    {
        $this->commonHelper = $commonHelper;
    }

    public function index()
    {
        return Product::with('category')->get();
    }

    public function store(Request $request): Product
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->commonHelper->upload($request->file('image'), 'products');
        }

        return Product::create($data);
    }

    public function show($id): Builder|array|Collection|Model
    {
        return Product::with('category')->findOrFail($id);
    }

    public function update(UpdateProductRequest $request, string $id): Product
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                $this->commonHelper->delete("products/{$product->image}");
            }

            $data['image'] = $this->commonHelper->upload(
                $request->file('image'),
                'products'
            );
        }

        $product->update($data);

        return $product;
    }


    public function destroy(Product $product): bool
    {
        if ($product->image) {
            $this->commonHelper->delete("products/{$product->image}");
        }

        return $product->delete();
    }
}
