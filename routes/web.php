<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as EventAdminController;

// --- RUTE USER AREA ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', function () { return '<h1>Tentang</h1>'; });
Route::get('/kontak', function(){ return view('contact'); });
Route::get('/profil', function () { return view('profil'); });
Route::get('/katalog', function () { return view('katalog'); });
Route::get('/bantuan', function () { return view('bantuan'); });
Route::get('/event-detail', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// --- RUTE ADMIN AREA ---
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events-detail', [EventController::class, 'index'])->name('events');
    Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');
    Route::resource('events', EventAdminController::class);

    // Category Routes
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

    // Partner Routes
Route::get('/partners', [App\Http\Controllers\PartnerController::class, 'index'])->name('partners.index');
Route::post('/partners', [App\Http\Controllers\PartnerController::class, 'store'])->name('partners.store');
Route::put('/partners/{partner}', [App\Http\Controllers\PartnerController::class, 'update'])->name('partners.update');
Route::delete('/partners/{partner}', [App\Http\Controllers\PartnerController::class, 'destroy'])->name('partners.destroy');
});