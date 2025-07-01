<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TierListTemplateController;
use App\Http\Controllers\TemplateItemController;
use App\Http\Controllers\DashboardController;

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

    Route::resource('templates', TierListTemplateController::class);
});

require __DIR__.'/auth.php';
