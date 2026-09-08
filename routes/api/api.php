<?php
// api routes backend & frontend.
// src: routes/api/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ── Authenticated user ────────────────────────────────────────────────────────
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ── API v1 ────────────────────────────────────────────────────────────────────
Route::prefix('v1')->name('api.v1.')->group(function () {
    include __DIR__ . '/backend.php';
    include __DIR__ . '/frontend.php';
});
