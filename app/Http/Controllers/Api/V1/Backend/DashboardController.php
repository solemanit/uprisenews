<?php
// app/Http/Controllers/Api/V1/Backend/DashboardController.php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * GET /api/v1/dashboard
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => [
                'stats'           => $this->stats(),
                'recent_articles' => $this->recentArticles(),
                'top_categories'  => $this->topCategories(),
                'running_ads'     => $this->runningAds(),
                'chart'           => $this->articlesChartData(),
            ],
        ]);
    }

    protected function stats(): array
    {
        return [
            'articles' => [
                'total'     => Article::count(),
                'published' => Article::published()->count(),
                'draft'     => Article::where('status', 'draft')->count(),
                'today'     => Article::whereDate('created_at', today())->count(),
            ],
            'categories' => [
                'total'  => Category::count(),
                'active' => Category::active()->count(),
            ],
            'ads' => [
                'active'      => Ad::active()->count(),
                'running'     => Ad::currentlyRunning()->count(),
                'clicks'      => (int) Ad::sum('clicks_count'),
                'impressions' => (int) Ad::sum('impressions_count'),
            ],
            'pages' => [
                'total' => class_exists(Page::class) ? Page::count() : 0,
            ],
        ];
    }

    protected function recentArticles()
    {
        return Article::with(['category:id,name', 'author:id,name'])
            ->latest()
            ->take(8)
            ->get(['id', 'title', 'slug', 'status', 'category_id', 'author_id', 'published_at', 'created_at'])
            ->map(fn (Article $article) => [
                'id'            => $article->id,
                'title'         => $article->title,
                'slug'          => $article->slug,
                'status'        => $article->status,
                'status_badge'  => $article->status_badge,
                'category'      => $article->category?->name,
                'author'        => $article->author?->name,
                'published_at'  => $article->published_at?->toDateTimeString(),
                'created_at'    => $article->created_at->toDateTimeString(),
            ]);
    }

    protected function topCategories()
    {
        return Category::withCount('articles')
            ->orderByDesc('articles_count')
            ->take(5)
            ->get(['id', 'name', 'slug'])
            ->map(fn (Category $category) => [
                'id'             => $category->id,
                'name'           => $category->name,
                'slug'           => $category->slug,
                'articles_count' => $category->articles_count,
            ]);
    }

    protected function runningAds()
    {
        return Ad::currentlyRunning()
            ->orderByDesc('clicks_count')
            ->take(5)
            ->get(['id', 'title', 'slot', 'clicks_count', 'impressions_count', 'ends_at'])
            ->map(fn (Ad $ad) => [
                'id'                => $ad->id,
                'title'             => $ad->title,
                'slot'              => $ad->slot,
                'clicks_count'      => $ad->clicks_count,
                'impressions_count' => $ad->impressions_count,
                'ends_at'           => $ad->ends_at?->toDateTimeString(),
            ]);
    }

    protected function articlesChartData(): array
    {
        $days = collect(range(13, 0))->map(fn ($i) => Carbon::today()->subDays($i));

        $counts = Article::selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::today()->subDays(13))
            ->groupBy('day')
            ->pluck('total', 'day');

        return [
            'labels' => $days->map(fn ($d) => $d->format('M d'))->all(),
            'data'   => $days->map(fn ($d) => (int) ($counts[$d->toDateString()] ?? 0))->all(),
        ];
    }
}
