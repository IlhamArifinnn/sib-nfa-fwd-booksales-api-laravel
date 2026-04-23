<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the Book Sales API']);
});

// Route untuk Genres
Route::get('/genres', [GenreController::class, 'index']);      // Read all genres
Route::post('/genres', [GenreController::class, 'store']);     // Create genre

// Route untuk Authors
Route::get('/authors', [AuthorController::class, 'index']);    // Read all authors
Route::post('/authors', [AuthorController::class, 'store']);   // Create author

// Route untuk Books
Route::get('/books', [BookController::class, 'index']);        // Read all books
Route::post('/books', [BookController::class, 'store']);       // Create book
