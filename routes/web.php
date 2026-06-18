<?php

use App\Http\Controllers\PostPaginationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('posts/pagination', [PostPaginationController::class, 'normal'])
    ->name('posts.pagination.normal');

Route::get('posts/quick-pagination', [PostPaginationController::class, 'quick'])
    ->name('posts.pagination.quick');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
