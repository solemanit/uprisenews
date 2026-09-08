<?php
// routes backend api.
// src: routes/api/backend.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Backend\DashboardController as DashboardApiController;
use App\Http\Controllers\Api\V1\Backend\CategoryController as CategoryApiController;
use App\Http\Controllers\Api\V1\Backend\ArticleController  as ArticleApiController;
use App\Http\Controllers\Api\V1\Backend\AdController as AdApiController;
use App\Http\Controllers\Api\V1\Backend\MediaController as MediaApiController;
use App\Http\Controllers\Api\V1\Backend\MenuController as MenuApiController;
use App\Http\Controllers\Api\V1\Backend\PageController as PageApiController;

Route::get('dashboard', [DashboardApiController::class, 'index'])
    ->name('dashboard');   // api.v1.dashboard  ->  GET /api/v1/dashboard

// ── Categories ────────────────────────────────────────────────────────────
// lightweight list for dropdowns — must come before apiResource wildcard
Route::get('categories/list', [CategoryApiController::class, 'list'])
    ->name('categories.list');                                 // api.v1.categories.list

Route::apiResource('categories', CategoryApiController::class);
// api.v1.categories.index   GET    /api/v1/categories
// api.v1.categories.store   POST   /api/v1/categories
// api.v1.categories.show    GET    /api/v1/categories/{category}
// api.v1.categories.update  PUT    /api/v1/categories/{category}
// api.v1.categories.destroy DELETE /api/v1/categories/{category}

// ── Articles ──────────────────────────────────────────────────────────────
// lightweight list for dropdowns / related pickers — must come before apiResource wildcard
Route::get('articles/list', [ArticleApiController::class, 'list'])
    ->name('articles.list');                                   // api.v1.articles.list

// ⚠ IMPORTANT: constrained to numeric IDs only, so it never collides with
// the public frontend route GET /api/v1/articles/{slug} in api/frontend.php
Route::apiResource('articles', ArticleApiController::class)
    ->whereNumber('article');
// api.v1.articles.index   GET    /api/v1/articles
// api.v1.articles.store   POST   /api/v1/articles
// api.v1.articles.show    GET    /api/v1/articles/{article}   (numeric only)
// api.v1.articles.update  PUT    /api/v1/articles/{article}   (numeric only)
// api.v1.articles.destroy DELETE /api/v1/articles/{article}   (numeric only)

// ── Ads ───────────────────────────────────────────────────────────────────
Route::get('ads/slot/{slot}', [AdApiController::class, 'bySlot'])
    ->name('ads.by-slot');                                         // api.v1.ads.by-slot

Route::post('ads/{ad}/click',      [AdApiController::class, 'registerClick'])
    ->name('ads.click');
Route::post('ads/{ad}/impression', [AdApiController::class, 'registerImpression'])
    ->name('ads.impression');

Route::apiResource('media', MediaApiController::class)
    ->only(['index', 'store', 'show', 'destroy']);
// api.v1.media.index   GET    /api/v1/media
// api.v1.media.store   POST   /api/v1/media
// api.v1.media.show    GET    /api/v1/media/{medium}
// api.v1.media.destroy DELETE /api/v1/media/{medium}

Route::get('menus/{location}', [MenuApiController::class, 'byLocation'])
    ->name('menus.by-location'); // api.v1.menus.by-location

// ── Pages ─────────────────────────────────────────────────────────────────
Route::get('pages/list',        [PageApiController::class, 'list'])->name('pages.list');
Route::get('pages/key/{key}',   [PageApiController::class, 'byKey'])->name('pages.by-key');
Route::get('pages',             [PageApiController::class, 'index'])->name('pages.index');
Route::get('pages/{page}',      [PageApiController::class, 'show'])->name('pages.show');
