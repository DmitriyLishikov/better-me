<?php

namespace App\Actions;

use App\Models\Review;
use App\Models\User;

class FilterAction
{
    /**
     * @param array $params
     * @return mixed
     */
    public function __invoke(array $params): mixed
    {
        return Review::where('book_id', $params['book_id'])
            ->with('user')
            ->when($params['filter'] == 'author', function ($query) use ($params) {
                $query->orderBy(
                    User::whereColumn('id', 'reviews.user_id')
                        ->select('name')
                        ->orderBy('name')
                        ->limit(1),
                    $params['filterAuthorOrder']
                );
            })
            ->when($params['filter'] == 'date', function ($query) use ($params){
                $query->orderBy('created_at', $params['filterDateOrder']);
            })
            ->get();
    }
}
