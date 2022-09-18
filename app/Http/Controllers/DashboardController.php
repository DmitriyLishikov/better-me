<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'reviews' => Review::where('user_id', auth()->id())->with('book')->paginate(),
            'books'   => Book::where('user_id', auth()->id())->paginate(),
        ]);
    }
}
