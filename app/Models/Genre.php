<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'name' => 'Fiksi',
            'description' => 'Cerita rekaan yang bersifat imajinatif.',
        ],
        [
            'name' => 'Non-Fiksi',
            'description' => 'Buku berdasarkan fakta dan kenyataan.',
        ],
        [
            'name' => 'Biografi',
            'description' => 'Kisah hidup seseorang yang ditulis oleh orang lain.',
        ],
        [
            'name' => 'Motivasi',
            'description' => 'Buku yang memberikan dorongan semangat hidup.',
        ],
        [
            'name' => 'Teknologi',
            'description' => 'Buku yang membahas perkembangan teknologi.',
        ],
    ];

    public function getGenres()
    {
        return $this->genres;
    }
}
