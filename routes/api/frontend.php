<?php
// routes frontend api.
// src: routes/api/frontend.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Frontend\HomeController as HomeApiController;
use App\Http\Controllers\Api\V1\Frontend\ArticleController as ArticleApiController;

Route::get('home/sections', [HomeApiController::class, 'sections'])
    ->name('home.sections'); // api.v1.home.sections

Route::get('home/hero', [HomeApiController::class, 'hero'])
    ->name('home.hero'); // api.v1.home.hero

// Articles by category — must come before the single-article slug route
// so "categories/{slug}/articles" doesn't collide with "articles/{slug}".
Route::get('categories/{slug}/articles', [ArticleApiController::class, 'byCategory'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('public-articles.by-category'); // api.v1.public-articles.by-category

// ⚠ Distinct name from backend's api.v1.articles.show to avoid name collisions
// in route() URL generation. Constrained to non-numeric slugs so this route
// and the backend numeric route can coexist unambiguously on the same URI shape.
Route::get('articles/{slug}', [ArticleApiController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('public-articles.show'); // api.v1.public-articles.show

Route::get('home/latest', [HomeApiController::class, 'latest'])
    ->name('home.latest'); // api.v1.home.latest

Route::get('home/politics', [HomeApiController::class, 'politics'])
    ->name('home.politics'); // api.v1.home.politics

Route::get('home/trending', [HomeApiController::class, 'trending'])
    ->name('home.trending'); // api.v1.home.trending

Route::get('home/national', [HomeApiController::class, 'national'])
    ->name('home.national'); // api.v1.home.national

Route::get('home/economy', [HomeApiController::class, 'economy'])
    ->name('home.economy'); // api.v1.home.economy
