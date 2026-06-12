<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// TAMBAHKAN BARIS DI BAWAH INI:
use Illuminate\Support\Facades\Auth; 

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login dan rolenya adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin atau belum login, lempar kembali ke halaman login
        return redirect()->route('admin.login')->with('error', 'Akses ditolak! Anda bukan Admin.');
    }
}