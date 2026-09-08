<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /** GET /api/v1/home/hero */
    public function hero(): JsonResponse
    {
        $article = Article::query()
            ->published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->first();

        return response()->json([
            'data' => $article ? new ArticleResource($article) : null,
        ]);
    }

    /** GET /api/v1/home/latest */
    public function latest(): JsonResponse
    {
        $articles = Article::query()
            ->published()
            ->where('is_featured', false) // featured article already shown in hero — don't repeat it here
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(8)
            ->get();

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /** GET /api/v1/home/politics */
    public function politics(): JsonResponse
    {
        $articles = Article::query()
            ->published()
            ->whereHas('category', fn ($q) => $q->where('slug', 'politics'))
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(6)
            ->get();

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /** GET /api/v1/home/trending */
    public function trending(): JsonResponse
    {
        $articles = Article::query()
            ->published()
            ->where('published_at', '>=', now()->subDay())
            ->with(['category', 'author'])
            ->orderByDesc('views_count')
            ->take(12)
            ->get();

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /** GET /api/v1/home/national */
    public function national(): JsonResponse
    {
        $articles = Article::query()
            ->published()
            ->whereHas('category', fn ($q) => $q->where('slug', 'national'))
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(5)
            ->get();

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /** GET /api/v1/home/economy */
    public function economy(): JsonResponse
    {
        $articles = Article::query()
            ->published()
            ->whereHas('category', fn ($q) => $q->where('slug', 'economy'))
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(2)
            ->get();

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }
}
