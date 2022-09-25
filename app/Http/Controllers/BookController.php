<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookCreateRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;
use App\Services\BookService;
use Inertia\Inertia;

class BookController extends Controller
{

    /**
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Book/Create');
    }

    /**
     * @param BookCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookCreateRequest $request, BookService $bookService): \Illuminate\Http\RedirectResponse
    {
        $bookService->store($request);

        return redirect()->route('dashboard');
    }


    /**
     * @param int $book
     * @return \Inertia\Response
     */
    public function show(int $book, BookService $bookService): \Inertia\Response
    {
        return Inertia::render('Book/Show', [
            'book' => $bookService->show($book)
        ]);
    }

    /**
     * @param int $book
     * @param BookService $bookService
     * @return \Inertia\Response
     */
    public function edit(int $book, BookService $bookService): \Inertia\Response
    {
        return Inertia::render('Book/Update', [
            'book' => $bookService->getBook($book)
        ]);
    }

    /**
     * @param BookUpdateRequest $request
     * @param int $book
     * @param BookService $bookService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookUpdateRequest $request, int $book, BookService $bookService): \Illuminate\Http\RedirectResponse
    {
        $this->authorizeResource(Book::class, $book);

        $bookService->update($request->validated(), $book);

        return redirect()->route('dashboard');
    }

    /**
     * @param int $book
     * @param BookService $bookService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $book, BookService $bookService): \Illuminate\Http\RedirectResponse
    {
        $this->authorizeResource(Book::class, $book);

        $bookService->destroy($book);

        return redirect()->route('dashboard');
    }
}
