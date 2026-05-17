<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Author::insert([
            [
                'name' => 'Tere Liye',
                'photo' => 'tere_liye.png',
                'bio' => 'Penulis novel populer Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mark Manson',
                'photo' => 'mark_manson.png',
                'bio' => 'Penulis buku pengembangan diri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andrea Hirata',
                'photo' => 'andrea_hirata.png',
                'bio' => 'Penulis novel Laskar Pelangi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'James Clear',
                'photo' => 'james_clear.png',
                'bio' => 'Penulis buku Atomic Habits.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ilham Arifin',
                'photo' => 'ilham_arifin.png',
                'bio' => 'Pakar teknologi dan penulis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
