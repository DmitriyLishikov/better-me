<?php

namespace App\Http\Controllers;

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
        $reviews =  DB::table('books')
            ->select('books.*')
            ->join('reviews', 'books.id', '=', 'reviews.book_id')
            ->where('reviews.content', 'like', '%'.$request->search.'%');

        return Inertia::render('Search', [
            'results' => DB::table('books')
                ->where('title', 'like', '%'. $request->search. '%' )
                ->union($reviews)
                ->distinct()
                ->paginate()
        ]);
    }
}
