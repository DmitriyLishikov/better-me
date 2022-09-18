<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewsFilterController extends Controller
{


    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return Review::where('book_id', $request->book_id)
            ->with('user')
            ->when($request->filter == 'author', function ($query) use ($request) {
                $query->orderBy(
                    User::whereColumn('id', 'reviews.user_id')
                        ->select('name')
                        ->orderBy('name')
                        ->limit(1),
                    $request->filterAuthorOrder
                );
            })
            ->when($request->filter == 'date', function ($query) use ($request){
                $query->orderBy('created_at', $request->filterDateOrder);
            })
            ->get();
    }
}
