<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('author', 'genre');

        // Search by title, description, or author name
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by genre
        if ($request->has('genre_id')) {
            $query->where('genre_id', $request->get('genre_id'));
        }

        $books = $query->get();

        if ($books->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "No books found",
                'data' => []
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "List of Books",
            'data' => $books
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
        ]);

        // Handle file upload for cover photo to storage
        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('books', $filename, 'public');
            $validated['cover_photo'] = $path;
        }

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $book = Book::with('author', 'genre')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Book details',
                'data' => $book
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
                'data' => null
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);

            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'sometimes|required|integer|min:0',
                'stock' => 'sometimes|required|integer|min:0',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'author_id' => 'sometimes|required|exists:authors,id',
                'genre_id' => 'sometimes|required|exists:genres,id',
            ]);

            // Handle file upload for cover photo
            if ($request->hasFile('cover_photo')) {
                // Delete old cover photo if exists
                if ($book->cover_photo && Storage::disk('public')->exists($book->cover_photo)) {
                    Storage::disk('public')->delete($book->cover_photo);
                }

                $file = $request->file('cover_photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('books', $filename, 'public');
                $validated['cover_photo'] = $path;
            }

            $book->update($validated);

            // Load relationships for response
            $book->load('author', 'genre');

            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => $book
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
                'data' => null
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);

            // Delete cover photo file if exists
            if ($book->cover_photo && Storage::disk('public')->exists($book->cover_photo)) {
                Storage::disk('public')->delete($book->cover_photo);
            }

            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }
    }
}
