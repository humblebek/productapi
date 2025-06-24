<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CommonHelpers $commonHelper;
    protected CategoryService $categoryService;

    public function __construct(CommonHelpers $commonHelper,CategoryService $categoryService)
    {
        $this->commonHelper = $commonHelper;
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->index();
        return $this->commonHelper->returnResponse("Barcha kategoriyalar", $categories);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request);
        return $this->commonHelper->returnResponse("Kategoriya qo‘shildi", $category);
    }

    public function show($id): JsonResponse
    {
        $category = $this->categoryService->show($id);
        if (!$category) {
            return $this->commonHelper->returnResponse("Kategoriya topilmadi", null, 404);
        }
        return $this->commonHelper->returnResponse("Kategoriya", $category);
    }

    public function update(UpdateCategoryRequest $request, $id): JsonResponse
    {

        $updated = $this->categoryService->update($request, $id);
        return $this->commonHelper->returnResponse("Kategoriya yangilandi", $updated);
    }

    public function destroy(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $this->categoryService->destroy($category);
        return $this->commonHelper->returnResponse("Kategoriya muvaffaqiyatli o‘chirildi");
    }

}
