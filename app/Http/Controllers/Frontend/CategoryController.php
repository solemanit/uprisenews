<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * GET /category/{slug}
     * route name: category.show
     *
     * Blade shell only — actual article data loaded client-side via
     * category-articles-loader.js -> GET /api/v1/categories/{slug}/articles
     */
    public function show(string $slug): View
    {
        return view('frontend.category.index', [
            'slug' => $slug,
        ]);
    }
}
