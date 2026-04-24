<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // 1. Akun Admin Utama
        User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Insert Kategori Event (Minimal 3 Kategori)
        $catIT = Category::create(['name' => 'Technology', 'slug' => 'technology']);
        $catSport = Category::create(['name' => 'E-Sport', 'slug' => 'e-sport']);
        $catDesign = Category::create(['name' => 'Design & Creative', 'slug' => 'design-creative']);

        // 3. Insert Sampel Events (Minimal 6 Event Beragam)
        
        // --- Kategori Technology ---
        Event::create([
            'category_id' => $catIT->id,
            'title' => 'AI & Future Tech Summit 2026',
            'description' => 'Jelajahi tren terkini dalam kecerdasan buatan bersama para ahli.',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Cinema Unit 6',
            'price' => 75000,
            'stock' => 50,
            'poster_path' => 'posters/event-1.png',
        ]);

        Event::create([
            'category_id' => $catIT->id,
            'title' => 'Backend Laravel Deep Dive',
            'description' => 'Workshop intensif membangun API scalable dengan Laravel 11.',
            'date' => '2026-05-15 09:00:00',
            'location' => 'Lab ICT Amikom',
            'price' => 150000,
            'stock' => 30,
            'poster_path' => 'posters/event-2.png',
        ]);

        // --- Kategori E-Sport ---
        Event::create([
            'category_id' => $catSport->id,
            'title' => 'E-Sport U-Champ: Mobile Legends',
            'description' => 'Turnamen bergengsi antar mahasiswa memperebutkan piala Rektor.',
            'date' => '2026-06-10 10:00:00',
            'location' => 'Basement Gedung 4',
            'price' => 25000,
            'stock' => 200,
            'poster_path' => 'posters/event-3.png',
        ]);

        Event::create([
            'category_id' => $catSport->id,
            'title' => 'Valorant Community Cup',
            'description' => 'Tunjukkan kemampuan aim kamu di kompetisi Valorant tingkat regional.',
            'date' => '2026-06-20 13:00:00',
            'location' => 'Online Tournament',
            'price' => 0, // Free
            'stock' => 64,
            'poster_path' => 'posters/event-4.png',
        ]);

        // --- Kategori Design ---
        Event::create([
            'category_id' => $catDesign->id,
            'title' => 'UI/UX Masterclass: From Zero to Hero',
            'description' => 'Belajar desain antarmuka yang user-friendly dengan Figma.',
            'date' => '2026-07-05 08:00:00',
            'location' => 'Ruang Citra 2',
            'price' => 100000,
            'stock' => 40,
            'poster_path' => 'posters/event-5.png',
        ]);

        Event::create([
            'category_id' => $catDesign->id,
            'title' => 'Digital Illustration Workshop',
            'description' => 'Teknik mewarnai karakter digital menggunakan pen tablet.',
            'date' => '2026-07-12 14:00:00',
            'location' => 'Amikom Creative Economy Park',
            'price' => 85000,
            'stock' => 25,
            'poster_path' => 'posters/event-6.png',
        ]);

        // Akun Test Tambahan
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}