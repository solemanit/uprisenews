<?php
// routes/frontend.php
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Listing page (no slug)
    Route::get('/news-deatils', [ArticleController::class, 'index'])->name('article');

    // Details page
    Route::get('/news-deatils/{slug}', [ArticleController::class, 'show'])->name('article.show');

    // Category page
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
});
