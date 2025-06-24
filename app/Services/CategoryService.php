<?php

namespace App\Services;

use App\Models\Category;
use App\Helpers\CommonHelpers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryService
{
    protected CommonHelpers $commonHelper;

    public function __construct(CommonHelpers $commonHelper)
    {
        $this->commonHelper = $commonHelper;
    }

    public function index(): Collection
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $this->commonHelper->upload($request->file('image'), 'categories');
        }

        return Category::create($validated);
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function update(UpdateCategoryRequest $request, string $id): Category
    {
        $validated = $request->validated();

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->commonHelper->delete("categories/{$category->image}");
            }
            $validated['image'] = $this->commonHelper->upload(
                $request->file('image'),
                'categories'
            );
        }

        $category->update(array_filter($validated));

        return $category->fresh();
    }



    public function destroy(Category $category): ?bool
    {
        if ($category->image) {
            $this->commonHelper->delete("categories/{$category->image}");
        }

        return $category->delete();
    }
}

