<?php
// routes/backend.php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AdController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;

$backendGroup = Route::middleware(['web', 'auth']);

if (app()->isProduction()) {
    $backendGroup = $backendGroup->domain('auth.' . config('app.domain'));
} else {
    $backendGroup = $backendGroup->prefix('');
}

$backendGroup->name('backend.')->group(function () {

    // ── Dashboard ─────────────────────────────────────────────────────────────
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');                                       // backend.dashboard

    // ── Profile ───────────────────────────────────────────────────────────────
    Route::get('/profile',    [ProfileController::class, 'edit'])
        ->name('profile.edit');                                    // backend.profile.edit
    Route::patch('/profile',  [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // ── Categories ────────────────────────────────────────────────────────────
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/',                [CategoryController::class, 'index'])->name('index');   // backend.categories.index
        Route::get('/create',          [CategoryController::class, 'create'])->name('create');
        Route::post('/',               [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}',      [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}',   [CategoryController::class, 'destroy'])->name('destroy');
    });

    // ── Articles ──────────────────────────────────────────────────────────────
    Route::prefix('articles')->name('articles.')->group(function () {

        // ⚠ Bulk destroy MUST come before /{article} wildcard routes
        Route::delete('/bulk-destroy', [ArticleController::class, 'bulkDestroy'])
            ->name('bulk-destroy');                                // backend.articles.bulk-destroy

        Route::get('/',                [ArticleController::class, 'index'])->name('index');    // backend.articles.index
        Route::get('/create',          [ArticleController::class, 'create'])->name('create');
        Route::post('/',               [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}',       [ArticleController::class, 'show'])->name('show');
        Route::get('/{article}/edit',  [ArticleController::class, 'edit'])->name('edit');
        Route::put('/{article}',       [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article}',    [ArticleController::class, 'destroy'])->name('destroy');
    });

    // ── Ads ───────────────────────────────────────────────────────────────────
    Route::prefix('ads')->name('ads.')->group(function () {

        // ⚠ Bulk destroy MUST come before /{ad} wildcard routes
        Route::delete('/bulk-destroy', [AdController::class, 'bulkDestroy'])
            ->name('bulk-destroy');                                    // backend.ads.bulk-destroy

        Route::get('/',                 [AdController::class, 'index'])->name('index');    // backend.ads.index
        Route::get('/create',           [AdController::class, 'create'])->name('create');
        Route::post('/',                [AdController::class, 'store'])->name('store');
        Route::get('/{ad}/edit',        [AdController::class, 'edit'])->name('edit');
        Route::put('/{ad}',             [AdController::class, 'update'])->name('update');
        Route::delete('/{ad}',          [AdController::class, 'destroy'])->name('destroy');
        Route::patch('/{ad}/toggle',    [AdController::class, 'toggleStatus'])->name('toggle-status');
    });

    Route::prefix('media')->name('media.')->group(function () {
        Route::delete('/bulk-destroy', [MediaController::class, 'bulkDestroy'])
            ->name('bulk-destroy');                                    // backend.media.bulk-destroy

        Route::get('/',              [MediaController::class, 'index'])->name('index');
        Route::post('/',             [MediaController::class, 'store'])->name('store');
        Route::post('/folder',       [MediaController::class, 'storeFolder'])->name('folder.store');
        Route::patch('/{medium}',    [MediaController::class, 'update'])->name('update');
        Route::delete('/{medium}',   [MediaController::class, 'destroy'])->name('destroy');
    });

    // ── Menus ─────────────────────────────────────────────────────────────────
    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/',                     [MenuController::class, 'index'])->name('index');
        Route::get('/create',               [MenuController::class, 'create'])->name('create');
        Route::post('/',                    [MenuController::class, 'store'])->name('store');
        Route::get('/{menu}/edit',          [MenuController::class, 'edit'])->name('edit');
        Route::put('/{menu}',               [MenuController::class, 'update'])->name('update');
        Route::delete('/{menu}',            [MenuController::class, 'destroy'])->name('destroy');
        Route::get('/{menu}/builder',       [MenuController::class, 'builder'])->name('builder');

        // AJAX item management
        Route::post('/items',               [MenuController::class, 'storeItem'])->name('items.store');
        Route::patch('/items/{item}',       [MenuController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}',      [MenuController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/items/reorder',       [MenuController::class, 'reorderItems'])->name('items.reorder');
    });

    // ── Pages ─────────────────────────────────────────────────────────────────
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::delete('/bulk-destroy', [PageController::class, 'bulkDestroy'])
            ->name('bulk-destroy');                                    // backend.pages.bulk-destroy

        Route::get('/',                [PageController::class, 'index'])->name('index');
        Route::get('/create',          [PageController::class, 'create'])->name('create');
        Route::post('/',               [PageController::class, 'store'])->name('store');
        Route::get('/{page}/edit',     [PageController::class, 'edit'])->name('edit');
        Route::put('/{page}',          [PageController::class, 'update'])->name('update');
        Route::delete('/{page}',       [PageController::class, 'destroy'])->name('destroy');
    });
});
