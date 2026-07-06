<?php
// app/Http/Controllers/Backend/ArticleController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::with(['category', 'author'])
            ->when($request->filled('status'),      fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->category_id))
            ->when($request->filled('search'),      fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->latest('published_at')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::active()->orderBy('name')->get(['id', 'name']);

        return view('backend.articles.index', compact('articles', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::active()->orderBy('sort_order')->orderBy('name')->get(['id', 'name', 'parent_id']);
        $authors    = User::orderBy('name')->get(['id', 'name']);

        return view('backend.articles.create', compact('categories', 'authors'));
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_breaking'] = $request->boolean('is_breaking');

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('articles/images', 'public');
        }

        $article = Article::create($data);

        // Auto-generate canonical URL based on the stored slug
        $article->canonical_url = url("/article/{$article->slug}");
        $article->saveQuietly();

        return redirect()
            ->route('backend.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article): View
    {
        $article->load(['category', 'author']);

        return view('backend.articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        $categories = Category::active()->orderBy('sort_order')->orderBy('name')->get(['id', 'name', 'parent_id']);
        $authors    = User::orderBy('name')->get(['id', 'name']);

        return view('backend.articles.edit', compact('article', 'categories', 'authors'));
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_breaking'] = $request->boolean('is_breaking');

        if ($request->hasFile('featured_image')) {
            $this->deleteFile($article->featured_image);
            $data['featured_image'] = $request->file('featured_image')
                ->store('articles/images', 'public');
        } elseif ($request->boolean('remove_featured_image')) {
            $this->deleteFile($article->featured_image);
            $data['featured_image'] = null;
        }

        $article->update($data);

        // Re-generate canonical URL if slug changed
        $article->canonical_url = url("/article/{$article->slug}");
        $article->saveQuietly();

        return redirect()
            ->route('backend.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->deleteFile($article->featured_image);

        $article->delete();

        return redirect()
            ->route('backend.articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    /**
     * Bulk delete selected articles.
     */
    public function bulkDestroy(Request $request): RedirectResponse
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()
                ->route('backend.articles.index')
                ->with('error', 'No articles selected.');
        }

        $articles = Article::whereIn('id', $ids)->get();

        foreach ($articles as $article) {
            $this->deleteFile($article->featured_image);
            $article->delete();
        }

        return redirect()
            ->route('backend.articles.index')
            ->with('success', count($ids) . ' article(s) deleted successfully.');
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    private function deleteFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
