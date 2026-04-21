<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    private $books = [
        [
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya.',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ],
        [
            'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
            'description' => 'Buku yang membahas tentang kehidupan dan filosofi hidup seseorang.',
            'price' => 25000,
            'stock' => 5,
            'cover_photo' => 'sebuah_seni.jpg',
            'genre_id' => 2,
            'author_id' => 2,
        ],
        [
            'title' => 'Laskar Pelangi',
            'description' => 'Kisah inspiratif anak-anak di Belitung.',
            'price' => 35000,
            'stock' => 10,
            'cover_photo' => 'laskar_pelangi.jpg',
            'genre_id' => 1,
            'author_id' => 3,
        ],
        [
            'title' => 'Atomic Habits',
            'description' => 'Panduan membangun kebiasaan baik.',
            'price' => 55000,
            'stock' => 8,
            'cover_photo' => 'atomic_habits.jpg',
            'genre_id' => 4,
            'author_id' => 4,
        ],
        [
            'title' => 'Teknologi Masa Depan',
            'description' => 'Membahas inovasi teknologi terbaru.',
            'price' => 60000,
            'stock' => 12,
            'cover_photo' => 'teknologi_masa_depan.jpg',
            'genre_id' => 5,
            'author_id' => 5,
        ],
    ];

    public function getBooks()
    {
        return $this->books;
    }
}
