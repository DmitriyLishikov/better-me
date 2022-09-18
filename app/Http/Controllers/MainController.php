<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;

class MainController extends Controller
{

    /**
     * @return \Inertia\Response
     */
    public function index(){
        return Inertia::render('Main', [
            'books' => Book::paginate(10),
        ]);
    }
}
