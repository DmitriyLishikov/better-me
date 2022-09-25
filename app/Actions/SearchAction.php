<?php

namespace App\Actions;

use App\Models\Book;

class SearchAction
{
    /**
     * @param array $params
     * @return mixed
     */
    public function __invoke(array $params): mixed
    {
        return Book::where('title', 'like', '%'. $params['search']. '%' )
            ->union(
                Book::select('books.*')
                ->join('reviews', 'books.id', '=', 'reviews.book_id')
                ->where('reviews.content', 'like', '%'. $params['search'] .'%')
            )
            ->distinct()
            ->paginate();
    }
}
