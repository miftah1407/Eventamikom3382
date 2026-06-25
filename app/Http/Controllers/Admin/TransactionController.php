<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction; // 1. IMPORT UTAMA: Agar data transaksi bisa ditarik dari database
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil transaksi terbaru dengan relasi data event dan pembatasan halaman
        $transactions = Transaction::with('event')->latest()->paginate(20);
        
        // Memastikan file view diarahkan ke folder admin -> folder transactions -> file index.blade.php
        return view('admin.transactions.index', compact('transactions'));
    }
}