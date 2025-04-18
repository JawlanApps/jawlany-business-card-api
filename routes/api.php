<?php

use App\Http\Controllers\DesignSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranslationController;

// Public routes
Route::get('/cards', [CardController::class, 'index']);
Route::get('/cards/{card}', [CardController::class, 'show']);
Route::get('/cards/category/{categoryId}', [CardController::class, 'getCardsByCategory']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/design-settings', [DesignSettingController::class, 'index']);
Route::get('/translations/{locale}', [TranslationController::class, 'getTranslations']);

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected admin routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Card management
    Route::post('/cards', [CardController::class, 'store']);
    Route::put('/cards/{card}', [CardController::class, 'update']);
    Route::delete('/cards/{card}', [CardController::class, 'destroy']);

    // Category management
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Optionally: logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Design management
    Route::post('/design-settings', [DesignSettingController::class, 'update']);
});

// Authenticated user info
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


