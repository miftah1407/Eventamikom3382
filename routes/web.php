<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DashboardController;

// --- RUTE USER AREA (PENGUNJUNG) ---
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', function () {
    return '<h1>Ini adalah Halaman Tentang Aplikasi Event Hub</h1>';
});

Route::get('/kontak', function(){ return view('contact'); });
Route::get('/profil', function () { return view('profil'); });
Route::get('/katalog', function () { return view('katalog'); });
Route::get('/bantuan', function () { return view('bantuan'); });

// Rute Detail & Checkout (DIBUAT STATIS SUPAYA TIDAK ERROR ID)
Route::get('/event-detail', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');


// --- RUTE ADMIN AREA ---
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // URL: /admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // URL: /admin/events-detail
    Route::get('/events-detail', [EventController::class, 'index'])->name('events');

    // URL: /admin/transactions
    Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');
});