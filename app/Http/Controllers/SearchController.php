<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SearchController extends Controller
{

    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Search', [
            'results' => Book::where('title', 'like', '%'. $request->search. '%' )
                ->union(Book::select('books.*')
                    ->join('reviews', 'books.id', '=', 'reviews.book_id')
                    ->where('reviews.content', 'like', '%'.$request->search.'%')
                )
                ->distinct()
                ->paginate()
        ]);
    }
}
