<?php

namespace App\Services;

use App\Http\Requests\Review\ReviewCreateRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Models\Review;

class ReviewService
{

    /**
     * @param int $review_id
     * @return mixed
     */
    public function getReview(int $review_id): mixed
    {
        return Review::where('id', $review_id)->firstOrFail();
    }

    /**
     * @param ReviewCreateRequest $request
     * @return void
     */
    public function store(ReviewCreateRequest $request): void
    {
        $request->merge(['user_id' => auth()->id()]);

        Review::create($request->all());
    }

    /**
     * @param array $fields
     * @param int $review_id
     * @return void
     */
    public function update(array $fields, int $review_id){
        $this->getReview($review_id)->update($fields);
    }

    /**
     * @param int $review_id
     * @return mixed
     */
    public function show(int $review_id): mixed
    {
        return Review::where('id', $review_id)->firstOrFail();
    }

    /**
     * @param int $review_id
     * @return void
     */
    public function destroy(int $review_id): void
    {
        Review::where('id', $review_id)->delete();
    }
}
