<?php
// app/Http/Controllers/Frontend/ArticleController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display the article index page.
     */
    public function index()
    {
        return view('frontend.article.index');
    }

    public function show(string $slug)
    {
        return view('frontend.article.index', compact('slug'));
    }
}
