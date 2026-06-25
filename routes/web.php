<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController; // 1. SUDAH DI-IMPORT AGAR TEPAT SASARAN
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EventController as AdminEventController; // 2. DI-ALIAS AGAR TIDAK BENTROK
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;

// ==========================================
// 1. --- RUTE USER AREA (AKSES PUBLIK) ---
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', function () { return '<h1>Tentang</h1>'; });
Route::get('/kontak', function(){ return view('contact'); });
Route::get('/profil', function () { return view('profil'); });
Route::get('/katalog', function () { return view('katalog'); });
Route::get('/bantuan', function () { return view('bantuan'); });
Route::get('/my-ticket', [AdminEventController::class, 'ticket'])->name('ticket');

// Perbaikan Rute Detail Event Publik (Modul Halaman 81)
Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('events.show');

// Rute Checkout Dinamis Tamu Tanpa Login (Modul Halaman 95)
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');


// ==========================================
// 2. --- RUTE SISI ADMIN AREA ---
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // --- AUTHENTICATION (BEBAS AKSES SEBELUM LOGIN) ---
    Route::get('login', [AuthController::class, 'showLogin'])->name('login'); 
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // --- PROTECTED ROUTES (HARUS LOGIN SEBAGAI ADMIN) ---
    Route::middleware(['auth', 'admin'])->group(function () {
        
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
        
        // Kelola Events (CRUD via Resource Route)
        Route::resource('events', AdminEventController::class);
        
        // Laporan Transaksi (Modul Halaman 97)
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');

        // Category Routes (CRUD)
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Partner Routes (CRUD)
        Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
        Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
        
    });
    
});