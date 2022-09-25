<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Services\UserDashboardService;
use Inertia\Inertia;

class DashboardController extends Controller
{

    /**
     * @param UserDashboardService $userDashboardService
     * @return \Inertia\Response
     */
    public function index(UserDashboardService $userDashboardService): \Inertia\Response
    {
        return Inertia::render('Dashboard', [
            'reviews' => $userDashboardService->getReviewsUser(auth()->id()),
            'books'   => $userDashboardService->getBooksUser(auth()->id()),
        ]);
    }
}
