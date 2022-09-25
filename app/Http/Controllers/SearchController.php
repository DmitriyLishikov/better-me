<?php

namespace App\Http\Controllers;

use App\Actions\SearchAction;
use App\Http\Resources\BookCollection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @param SearchAction $searchAction
     * @return \Inertia\Response
     */
    public function __invoke(Request $request, SearchAction $searchAction): \Inertia\Response
    {
        return Inertia::render('Search', [
            'results' => new BookCollection($searchAction($request->all()))
        ]);
    }
}
