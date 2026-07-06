<?php
// app/Http/Controllers/Backend/DashboardController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('backend.dashboard', [
            'stats'          => $this->stats(),
            'recentArticles' => $this->recentArticles(),
            'topCategories'  => $this->topCategories(),
            'runningAds'     => $this->runningAds(),
            'chart'          => $this->articlesChartData(),
        ]);
    }

    /**
     * Top-row summary cards.
     */
    protected function stats(): array
    {
        return [
            'articles_total'     => Article::count(),
            'articles_published' => Article::published()->count(),
            'articles_draft'     => Article::where('status', 'draft')->count(),
            'articles_today'     => Article::whereDate('created_at', today())->count(),

            'categories_total'  => Category::count(),
            'categories_active' => Category::active()->count(),

            'ads_active'  => Ad::active()->count(),
            'ads_running' => Ad::currentlyRunning()->count(),
            'ads_clicks'  => (int) Ad::sum('clicks_count'),
            'ads_impressions' => (int) Ad::sum('impressions_count'),

            'pages_total' => class_exists(Page::class) ? Page::count() : 0,
        ];
    }

    /**
     * Latest 8 articles for the activity table.
     */
    protected function recentArticles()
    {
        return Article::with(['category:id,name', 'author:id,name'])
            ->latest()
            ->take(8)
            ->get(['id', 'title', 'slug', 'status', 'category_id', 'author_id', 'published_at', 'created_at']);
    }

    /**
     * Categories ranked by article count.
     */
    protected function topCategories()
    {
        return Category::withCount('articles')
            ->orderByDesc('articles_count')
            ->take(5)
            ->get(['id', 'name', 'slug']);
    }

    /**
     * Ads currently live, ordered by clicks.
     */
    protected function runningAds()
    {
        return Ad::currentlyRunning()
            ->orderByDesc('clicks_count')
            ->take(5)
            ->get(['id', 'title', 'slot', 'clicks_count', 'impressions_count', 'ends_at']);
    }

    /**
     * Articles published per day, last 14 days — feeds the trend chart.
     */
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
