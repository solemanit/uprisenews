<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        return view('frontend.article.index');
    }
}
