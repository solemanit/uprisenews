<?php
// app/Http/Controllers/Backend/CategoryController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('parent')
            ->withCount('children')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('backend.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $parents = Category::active()
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('backend.categories.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['status'] = $request->boolean('status', true);

        Category::create($data);

        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        $parents = Category::active()
            ->whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('backend.categories.edit', compact('category', 'parents'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        $data['status'] = $request->boolean('status', $category->status);

        $category->update($data);

        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->children()->exists()) {
            return redirect()
                ->route('backend.categories.index')
                ->with('error', 'Cannot delete a category that has sub-categories.');
        }

        $category->delete();

        return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
