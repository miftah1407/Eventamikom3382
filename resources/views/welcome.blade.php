@extends('layouts.app')

@section('content')
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
            {{-- Menggunakan asset() agar gambar muncul stabil --}}
            <img src="{{ asset('assets/concert.png') }}" alt="Concert" class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">
        </div>
    </section>

    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                // Mengambil 3 event teratas secara aman untuk dipasangkan ke asset gambar lokal
                $event1 = $events[0] ?? null;
                $event2 = $events[1] ?? null;
                $event3 = $events[2] ?? null;
            @endphp

            <!-- KARTU 1: JAZZ NIGHT -->
            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="relative overflow-hidden aspect-[3/4]">
                        <img src="{{ asset('assets/concert.png') }}" alt="Jazz Night" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $event1 ? $event1->title : 'Jazz Night 2024' }}</h3>
                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">
                                {{ $event1 ? ($event1->price == 0 ? 'Gratis' : 'Rp ' . number_format($event1->price, 0, ',', '.')) : 'Rp 150.000' }}
                            </span>
                            <a href="{{ route('checkout.create', $event1 ? $event1->id : 1) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU 2: AI WORKSHOP -->
            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="relative overflow-hidden aspect-[3/4]">
                        <img src="{{ asset('assets/workshop.png') }}" alt="AI Workshop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $event2 ? $event2->title : 'AI & Future' }}</h3>
                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">
                                {{ $event2 ? ($event2->price == 0 ? 'Gratis' : 'Rp ' . number_format($event2->price, 0, ',', '.')) : 'Rp 50.000' }}
                            </span>
                            <a href="{{ route('checkout.create', $event2 ? $event2->id : 2) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU 3: HACKATHON -->
            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="relative overflow-hidden aspect-[3/4]">
                        <img src="{{ asset('assets/hackathon.png') }}" alt="Hackathon" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $event3 ? $event3->title : 'Hackathon 2024' }}</h3>
                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">
                                {{ $event3 ? ($event3->price == 0 ? 'Gratis' : 'Rp ' . number_format($event3->price, 0, ',', '.')) : 'Gratis' }}
                            </span>
                            <a href="{{ route('checkout.create', $event3 ? $event3->id : 3) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Partner --}}
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold mb-2">🤝 Partner Kami</h2>
            <p class="text-slate-500 font-medium">Didukung oleh berbagai partner terpercaya di platform AmikomEventHub</p>
        </div>

        {{-- Daftar Kategori --}}
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