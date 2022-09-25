<?php

namespace App\Services;

use App\Http\Requests\Book\BookCreateRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;

class BookService
{

    /**
     * @param int $book_id
     * @return mixed
     */
    public function getBook(int $book_id): mixed
    {
        return Book::where('id', $book_id)->firstOrFail();
    }

    /**
     * @param BookCreateRequest $request
     * @return void
     */
    public function store(BookCreateRequest $request): void
    {
        $request->merge(['user_id' => auth()->id()]);

        Book::create($request->all());
    }

    /**
     * @param int $book_id
     * @return mixed
     */
    public function show(int $book_id): mixed
    {
        return Book::where('id', $book_id)->with(['reviews.user'])->firstOrFail();
    }

    /**
     * @param array $fields
     * @param int $book_id
     * @return void
     */
    public function update(array $fields, int $book_id): void
    {
        $this->getBook($book_id)->update($fields);
    }

    /**
     * @param int $book_id
     * @return void
     */
    public function destroy(int $book_id): void
    {
        Book::where('id', $book_id)->delete();
    }

}
