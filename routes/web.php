<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;

Route::get('/', [FrontendController::class, 'index'])->name('website');
Route::get('/search-results', [FrontendController::class, 'searchResults'])->name('search.results');
Route::get('/search-retail-names', [FrontendController::class, 'searchRetailNames']);

Route::middleware('guest')->group(function () {
    // Brand owner registration
    Route::get('/brand-owner-register', [UserController::class, 'brand_form']);
    Route::post('/brand-owner-register', [UserController::class, 'brand_form_store'])
        ->name('brand-owner-register');

    // Store owner registration
    Route::get('/store-owner-register', [UserController::class, 'store_form']);
    Route::post('/store-owner-register', [UserController::class, 'store_form_store'])
        ->name('store-owner-register');
});
