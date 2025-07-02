<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TierListTemplateController;
use App\Http\Controllers\TemplateItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RankingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/templates/{template}/items', [TemplateItemController::class, 'store'])->name('items.store');
    Route::delete('/items/{item}', [TemplateItemController::class, 'destroy'])->name('items.destroy');
    
    // Pindahkan Route::resource ke bawah
    Route::get('/ranking/{template}', [RankingController::class, 'show'])->name('ranking.show');
    Route::post('/ranking/{template}', [RankingController::class, 'store'])->name('ranking.store');
    
    // Letakkan Route::resource di bagian akhir dalam grup
    Route::resource('templates', TierListTemplateController::class);
});

require __DIR__.'/auth.php';
