<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;

$backendGroup = Route::middleware(['web', 'auth']);

if (app()->isProduction()) {
    $backendGroup = $backendGroup->domain('auth.' . config('app.domain'));
} else {
    $backendGroup = $backendGroup->prefix('');
}

$backendGroup->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile',    [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});
