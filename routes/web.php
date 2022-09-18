<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);
Route::post('/book-review-filter', \App\Http\Controllers\ReviewsFilterController::class);
Route::get('/search', \App\Http\Controllers\SearchController::class)->name('search');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reviews/{book}/create', [\App\Http\Controllers\ReviewsController::class, 'create'])->name('reviews.create');
    Route::resource('books', \App\Http\Controllers\BookController::class)->only([
        'edit', 'store', 'update', 'destroy', 'create'
    ]);;
    Route::resource('reviews', \App\Http\Controllers\ReviewsController::class)->only([
        'edit', 'store', 'update', 'destroy',
    ]);
});
Route::get('/books/{book}', [\App\Http\Controllers\BookController::class, 'show'])->name('books.show');
Route::get('/reviews/{review}', [\App\Http\Controllers\ReviewsController::class, 'show'])->name('reviews.show');
