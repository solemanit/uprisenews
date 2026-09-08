<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    /**
     * GET /api/v1/articles/{slug}
     * route name: api.v1.public-articles.show
     */
    public function show(string $slug, Request $request): ArticleResource
    {
        $article = Article::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->firstOrFail(); // ModelNotFoundException -> global handler returns JSON 404

        $article->increment('views_count');

        return new ArticleResource($article);
    }

    /**
     * GET /api/v1/categories/{slug}/articles
     * route name: api.v1.public-articles.by-category
     */
    public function byCategory(string $slug, Request $request): AnonymousResourceCollection
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->active()
            ->firstOrFail(); // ModelNotFoundException -> global handler returns JSON 404

        $articles = Article::query()
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);

        return ArticleResource::collection($articles)
            ->additional([
                'category' => new CategoryResource($category), // top-level, pagination meta অক্ষত থাকে
            ]);
    }
}
