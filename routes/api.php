<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the Book Sales API']);
});

// Route untuk Genres
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
// Route untuk Authors
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
// Route untuk Books
Route::apiResource('books', BookController::class)->only(['index', 'show']);


Route::middleware(['auth:api'])->group(function () {
    // Route untuk Transactions
    Route::apiResource('transactions', TransactionController::class)->only(['index', 'show', 'store']);
    // Route untuk Transactions
    Route::apiResource('transactions', TransactionController::class)->only(['update', 'destroy']);

    Route::middleware(['role:admin'])->group(function () {
        // Route untuk Genres
        Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
        // Route untuk Authors
        Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);
        // Route untuk Books
        Route::apiResource('books', BookController::class)->only(['store', 'update', 'destroy']);
        // Route untuk Users
        Route::apiResource('users', UserController::class)->only(['index', 'show', 'update', 'destroy']);
    });
});

// Route untuk Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
