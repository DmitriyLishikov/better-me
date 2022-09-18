<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookCreateRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;
use Inertia\Inertia;

class BookController extends Controller
{

    /**
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Book/Create');
    }

    /**
     * @param BookCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookCreateRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        Book::create($request->all());

        return redirect()->route('dashboard');
    }


    /**
     * @param Book $book
     * @return \Inertia\Response
     */
    public function show(Book $book)
    {
        return Inertia::render('Book/Show', [
            'book' => $book->load(['reviews.user']),
        ]);
    }

    /**
     * @param Book $book
     * @return \Inertia\Response
     */
    public function edit(Book $book)
    {
        return Inertia::render('Book/Update', [
            'book' => $book,
        ]);
    }

    /**
     * @param BookUpdateRequest $request
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->update($request->validated());

        return redirect()->route('dashboard');
    }

    /**
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('dashboard');
    }
}
