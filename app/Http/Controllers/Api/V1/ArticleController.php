<?php
// app/Http/Controllers/Api/V1/ArticleController.php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * GET /api/v1/articles
     *
     * Supported query params:
     *   status, category_id, is_featured, is_breaking, search,
     *   per_page (default 15)
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $articles = Article::query()
            ->with(['category', 'author'])
            ->when($request->filled('status'),      fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->category_id))
            ->when($request->filled('is_featured'), fn ($q) => $q->where('is_featured', $request->boolean('is_featured')))
            ->when($request->filled('is_breaking'), fn ($q) => $q->where('is_breaking', $request->boolean('is_breaking')))
            ->when($request->filled('search'),      fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->latest('published_at')
            ->paginate($request->integer('per_page', 15));

        return ArticleResource::collection($articles);
    }

    /**
     * POST /api/v1/articles
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_breaking'] = $request->boolean('is_breaking');

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('articles/images', 'public');
        }

        $article = Article::create($data);

        return response()->json([
            'message' => 'Article created successfully.',
            'data'    => new ArticleResource($article->load(['category', 'author'])),
        ], 201);
    }

    /**
     * GET /api/v1/articles/{article}
     *
     * Returns full body + SEO block.
     * Increments views_count for unauthenticated (public) requests.
     */
    public function show(Article $article): JsonResponse
    {
        if (! request()->bearerToken()) {
            $article->increment('views_count');
        }

        return response()->json([
            'data' => new ArticleResource($article->load(['category', 'author'])),
        ]);
    }

    /**
     * PUT /api/v1/articles/{article}
     */
    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $data = $request->validated();

        $data['is_featured'] = $request->boolean('is_featured', $article->is_featured);
        $data['is_breaking'] = $request->boolean('is_breaking', $article->is_breaking);

        if ($request->hasFile('featured_image')) {
            $this->deleteFile($article->featured_image);
            $data['featured_image'] = $request->file('featured_image')
                ->store('articles/images', 'public');
        } elseif ($request->boolean('remove_featured_image')) {
            $this->deleteFile($article->featured_image);
            $data['featured_image'] = null;
        }

        $article->update($data);

        return response()->json([
            'message' => 'Article updated successfully.',
            'data'    => new ArticleResource($article->load(['category', 'author'])),
        ]);
    }

    /**
     * DELETE /api/v1/articles/{article}
     */
    public function destroy(Article $article): JsonResponse
    {
        $this->deleteFile($article->featured_image);

        $article->delete();

        return response()->json(['message' => 'Article deleted successfully.']);
    }

    /**
     * GET /api/v1/articles/list
     *
     * Lightweight list for dropdowns / related article pickers.
     * No pagination — published only.
     */
    public function list(): JsonResponse
    {
        $articles = Article::published()
            ->latest('published_at')
            ->get(['id', 'title', 'slug', 'category_id']);

        return response()->json(['data' => $articles]);
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    private function deleteFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
