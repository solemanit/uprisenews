<?php
// app/Http/Controllers/Frontend/SitemapController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * GET /sitemap.xml
     */
    public function index(): Response
    {
        $xml = Cache::remember('frontend.sitemap.xml', now()->addHour(), function () {
            $urls = collect();

            Article::published()
                ->orderByDesc('published_at')
                ->get(['slug', 'updated_at'])
                ->each(function (Article $article) use ($urls) {
                    $urls->push([
                        'loc'        => url('/article/' . $article->slug),
                        'lastmod'    => $article->updated_at->toAtomString(),
                        'changefreq' => 'daily',
                        'priority'   => '0.8',
                    ]);
                });

            Category::active()
                ->orderBy('name')
                ->get(['slug', 'updated_at'])
                ->each(function (Category $category) use ($urls) {
                    $urls->push([
                        'loc'        => url('/category/' . $category->slug),
                        'lastmod'    => $category->updated_at->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority'   => '0.6',
                    ]);
                });

            return view('frontend.sitemaps.index', ['urls' => $urls])->render();
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
