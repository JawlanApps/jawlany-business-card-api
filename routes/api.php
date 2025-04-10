<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public routes
Route::controller(CardController::class)->group(function () {
    Route::get('cards', [CardController::class, 'index']);
    Route::get('cards/{card}', [CardController::class, 'show']);
    Route::post('cards', [CardController::class, 'store']);
    Route::put('cards/{card}', [CardController::class, 'update']);
    Route::delete('cards/{card}', [CardController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/db-test', function() {
    try {
        \DB::connection()->getPdo();
        return 'DB connected!';
    } catch (\Exception $e) {
        return 'DB connection failed: ' . $e->getMessage();
    }
});
Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
});

