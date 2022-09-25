<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Review;

class UserDashboardService
{

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getBooksUser(int $user_id): mixed
    {
        return Book::where('user_id', $user_id)->paginate();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getReviewsUser(int $user_id): mixed
    {
        return Review::where('user_id', $user_id)->with('book')->paginate();
    }
}
