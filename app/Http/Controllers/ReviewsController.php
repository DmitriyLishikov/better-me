<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewCreateRequest;
use App\Models\Book;
use App\Models\Review;
use Inertia\Inertia;

class ReviewsController extends Controller
{

    /**
     * @param Book $book
     * @return \Inertia\Response
     */
    public function create(Book $book)
    {
        return Inertia::render('Review/Create', [
            'book' => $book,
        ]);
    }

    /**
     * @param ReviewCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReviewCreateRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        Review::create($request->all());

        return redirect()->route('books.show', ['book' => $request->book_id]);
    }

    /**
     * @param Review $review
     * @return \Inertia\Response
     */
    public function show(Review $review)
    {
        return Inertia::render('Review/Show', [
            'review' => $review,
            'user'   => $review->user()->first()
        ]);
    }

    /**
     * @param Review $review
     * @return \Inertia\Response
     */
    public function edit(Review $review)
    {
        return Inertia::render('Review/Update', [
            'review' => $review,
        ]);
    }

    /**
     * @param ReviewCreateRequest $request
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReviewCreateRequest $request, Review $review)
    {
        $review->update($request->validated());

        return redirect()->route('dashboard');
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back();
    }
}
