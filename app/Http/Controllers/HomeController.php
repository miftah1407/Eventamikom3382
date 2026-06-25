<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Partner; // Ditambahkan agar data partner di welcome blade tidak error

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil data event beserta kategorinya (Eager Loading)
        $events = Event::with('category')->latest()->get();

        // 2. Ambil semua kategori untuk bagian bawah halaman
        $categories = Category::all();

        // 3. Ambil semua data partner untuk bagian bawah halaman
        $partners = Partner::all();

        // 4. Kirim ketiga variabel tersebut ke view welcome
        return view('welcome', compact('events', 'categories', 'partners'));
    }
}