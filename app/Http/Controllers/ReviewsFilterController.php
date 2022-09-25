<?php

namespace App\Http\Controllers;

use App\Actions\FilterAction;
use Illuminate\Http\Request;

class ReviewsFilterController extends Controller
{

    public function __invoke(Request $request, FilterAction $filterAction)
    {
        return $filterAction($request->all());
    }
}
