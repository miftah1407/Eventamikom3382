@extends('layouts.app')

@section('content')
    {{-- Section Hero --}}
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                #1 Event Platform
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                    Mulai Jelajah
                </a>
                <a href="#" class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <img src="{{ asset('assets/concert.png') }}" alt="Concert" class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">
        </div>
    </section>

    {{-- Section Grid List Events --}}
    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- PERULANGAN DATA EVENT DINAMIS DARI DATABASE --}}
            @forelse($events as $event)
            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    {{-- Mengecek file poster asli di storage, jika kosong pakai gambar cadangan (placeholder) --}}
                    <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/300x400' }}" 
                         alt="{{ $event->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-1 text-slate-800">{{ $event->title }}</h3>
                    <p class="text-xs text-slate-400 mb-4">{{ $event->category->name ?? 'Umum' }} • {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <span class="text-2xl font-black text-indigo-600">
                            {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                        </span>
                        {{-- MENGARAHKAN LANGSUNG KE FORM CHECKOUT BERDASARKAN ID EVENT --}}
                        <a href="{{ route('checkout.create', $event->id) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-10">
                <p class="text-slate-400 font-medium">Belum ada acara terdekat yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- Section Partner & Kategori --}}
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold mb-2">🤝 Partner Kami</h2>
            <p class="text-slate-500 font-medium">Didukung oleh berbagai partner terpercaya di platform AmikomEventHub</p>
        </div>

        {{-- Daftar Kategori Tab --}}
        <div class="flex gap-3 flex-wrap mb-10 justify-center">
            @foreach($categories as $category)
            <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">
                {{ $category->name }}
            </span>
            @endforeach
        </div>

        {{-- Grid Partner --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($partners as $partner)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center gap-4 hover:shadow-lg transition">
                <img src="{{ asset('storage/' . $partner->logo_url) }}"
                    alt="{{ $partner->name }}"
                    class="h-16 w-auto object-contain">
                <p class="font-bold text-slate-700 text-center">{{ $partner->name }}</p>
            </div>
            @empty
            <p class="text-slate-400 col-span-4 text-center">Belum ada partner.</p>
            @endforelse
        </div>
    </section>
@endsection