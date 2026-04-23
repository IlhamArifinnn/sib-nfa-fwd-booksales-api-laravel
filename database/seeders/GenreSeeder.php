<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::insert([
            [
                'name' => 'Fiksi',
                'description' => 'Cerita rekaan yang bersifat imajinatif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Non-Fiksi',
                'description' => 'Buku berdasarkan fakta dan kenyataan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Biografi',
                'description' => 'Kisah hidup seseorang yang ditulis oleh orang lain.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Motivasi',
                'description' => 'Buku yang memberikan dorongan semangat hidup.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Buku yang membahas perkembangan teknologi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
