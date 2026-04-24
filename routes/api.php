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
Route::apiResource('genres', GenreController::class);

// Route untuk Authors
Route::apiResource('authors', AuthorController::class);

// Route untuk Books
Route::apiResource('books', BookController::class);
