<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'name' => 'Tere Liye',
            'photo' => 'tere_liye.jpg',
            'bio' => 'Penulis novel populer Indonesia.',
        ],
        [
            'name' => 'Mark Manson',
            'photo' => 'mark_manson.jpg',
            'bio' => 'Penulis buku pengembangan diri.',
        ],
        [
            'name' => 'Andrea Hirata',
            'photo' => 'andrea_hirata.jpg',
            'bio' => 'Penulis novel Laskar Pelangi.',
        ],
        [
            'name' => 'James Clear',
            'photo' => 'james_clear.jpg',
            'bio' => 'Penulis buku Atomic Habits.',
        ],
        [
            'name' => 'Ilham Arifin',
            'photo' => 'ilham_arifin.jpg',
            'bio' => 'Pakar teknologi dan penulis.',
        ],
    ];

    public function getAuthors()
    {
        return $this->authors;
    }
}
