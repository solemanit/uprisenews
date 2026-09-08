<?php
// app/Http/Controllers/Api/V1/Backend/CategoryController.php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * GET /api/v1/categories
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $categories = Category::query()
            ->with('parent')
            ->withCount('children')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->boolean('status')))
            ->when($request->filled('parent_id'), fn ($q) => $q->where('parent_id', $request->parent_id))
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate($request->integer('per_page', 15));

        return CategoryResource::collection($categories);
    }

    /**
     * POST /api/v1/categories
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['status'] = $request->boolean('status', true);

        $category = Category::create($data);

        return response()->json([
            'message' => 'Category created successfully.',
            'data'    => new CategoryResource($category->load('parent')),
        ], 201);
    }

    /**
     * GET /api/v1/categories/{category}
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'data' => new CategoryResource($category->load('parent')->loadCount('children')),
        ]);
    }

    /**
     * PUT /api/v1/categories/{category}
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = $request->validated();

        $data['status'] = $request->boolean('status', $category->status);

        $category->update($data);

        return response()->json([
            'message' => 'Category updated successfully.',
            'data'    => new CategoryResource($category->load('parent')),
        ]);
    }

    /**
     * DELETE /api/v1/categories/{category}
     */
    public function destroy(Category $category): JsonResponse
    {
        // Prevent delete if has children
        if ($category->children()->exists()) {
            return response()->json([
                'message' => 'Cannot delete a category that has sub-categories. Remove children first.',
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.',
        ]);
    }

    /**
     * GET /api/v1/categories/list — lightweight for dropdowns
     */
    public function list(): JsonResponse
    {
        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'parent_id']);

        return response()->json(['data' => $categories]);
    }
}
