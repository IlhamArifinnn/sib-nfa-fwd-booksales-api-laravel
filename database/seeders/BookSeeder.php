<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Book::insert([
            [
                'title' => 'Pulang',
                'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya.',
                'price' => 40000,
                'stock' => 15,
                'cover_photo' => 'pulang.png',
                'genre_id' => 1,
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
                'description' => 'Buku yang membahas tentang kehidupan dan filosofi hidup seseorang.',
                'price' => 25000,
                'stock' => 5,
                'cover_photo' => 'sebuah-seni.png',
                'genre_id' => 2,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laskar Pelangi',
                'description' => 'Kisah inspiratif anak-anak di Belitung.',
                'price' => 35000,
                'stock' => 10,
                'cover_photo' => 'laskar-pelangi.png',
                'genre_id' => 1,
                'author_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Atomic Habits',
                'description' => 'Panduan membangun kebiasaan baik.',
                'price' => 55000,
                'stock' => 8,
                'cover_photo' => 'atomic-habits.png',
                'genre_id' => 3,
                'author_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Teknologi Masa Depan',
                'description' => 'Membahas inovasi teknologi terbaru.',
                'price' => 60000,
                'stock' => 12,
                'cover_photo' => 'teknologi.png',
                'genre_id' => 4,
                'author_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}