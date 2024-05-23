<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('sort_by')) {
            $books->orderBy($request->get('sort_by'), 'asc');
        }

        return response()->json($books->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            dd('Validation failed', $validator->errors());
            return response()->json($validator->errors(), 422);
        }

        $book = Book::create($request->only(['title', 'author']));
        Log::info('Book created successfully', $book->toArray());
        dd('Book created successfully', $book);

        return response()->json($book, 201);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Validate incoming request if needed
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        // Update the book with validated data
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
        ]);

        // Optionally, return the updated resource as a JSON response
        return response()->json($book);
    }
}
