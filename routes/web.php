<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TierListTemplateController;
use App\Http\Controllers\TemplateItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/ranking/{template}', [RankingController::class, 'show'])->name('ranking.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/templates/{template}/items', [TemplateItemController::class, 'store'])->name('items.store');
    Route::delete('/items/{item}', [TemplateItemController::class, 'destroy'])->name('items.destroy');

    Route::post('/ranking/{template}', [RankingController::class, 'store'])->name('ranking.store');

    Route::resource('templates', TierListTemplateController::class);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['create', 'store', 'edit', 'update']);
});

require __DIR__.'/auth.php';
