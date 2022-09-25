<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewCreateRequest;
use App\Models\Book;
use App\Models\Review;
use App\Services\BookService;
use App\Services\ReviewService;
use Inertia\Inertia;

class ReviewsController extends Controller
{

    /**
     * @param int $book
     * @param BookService $bookService
     * @return \Inertia\Response
     */
    public function create(int $book, BookService $bookService): \Inertia\Response
    {
        return Inertia::render('Review/Create', [
            'book' => $bookService->getBook($book),
        ]);
    }

    /**
     * @param ReviewCreateRequest $request
     * @param ReviewService $reviewService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReviewCreateRequest $request, ReviewService $reviewService): \Illuminate\Http\RedirectResponse
    {
        $reviewService->store($request);

        return redirect()->route('books.show', ['book' => $request->book_id]);
    }

    /**
     * @param int $review
     * @param ReviewService $reviewService
     * @return \Inertia\Response
     */
    public function show(int $review, ReviewService $reviewService): \Inertia\Response
    {
        $review = $reviewService->show($review);

        return Inertia::render('Review/Show', [
            'review' => $review,
            'user'   => $review->user()->first()
        ]);
    }


    public function edit(int $review, ReviewService $reviewService)
    {
        return Inertia::render('Review/Update', [
            'review' => $reviewService->getReview($review),
        ]);
    }

    /**
     * @param ReviewCreateRequest $request
     * @param int $review
     * @param ReviewService $reviewService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReviewCreateRequest $request, int $review, ReviewService $reviewService): \Illuminate\Http\RedirectResponse
    {
        $this->authorizeResource(Review::class, $review);

        $reviewService->update($request->validated(), $review);

        return redirect()->route('dashboard');
    }

    /**
     * @param int $review
     * @param ReviewService $reviewService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $review, ReviewService $reviewService): \Illuminate\Http\RedirectResponse
    {
        $this->authorizeResource(Review::class, $review);

        $reviewService->destroy($review);

        return redirect()->back();
    }
}
