<?php
// routes/frontend.php
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/news-deatils', [ArticleController::class, 'index'])->name('article');
    // seo sitemap
    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
});
