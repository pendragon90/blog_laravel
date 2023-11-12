<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['title' => 'Otaku', 'slug' => 'otaku-' . uniqid()],
            ['title' => 'Kawaii', 'slug' => 'kawaii-' . uniqid()],
            ['title' => 'Fanart', 'slug' => 'fanart-' . uniqid()],
            ['title' => 'Subbed Anime', 'slug' => 'subbed-anime-' . uniqid()],
            ['title' => 'Dubbed Anime', 'slug' => 'dubbed-anime-' . uniqid()],
            ['title' => 'Anime OST', 'slug' => 'anime-ost-' . uniqid()],
            ['title' => 'Anime Recommendations', 'slug' => 'anime-recommendations-' . uniqid()],
            ['title' => 'Anime Industry', 'slug' => 'anime-industry-' . uniqid()],
            ['title' => 'Anime History', 'slug' => 'anime-history-' . uniqid()],
            ['title' => 'Anime Streaming', 'slug' => 'anime-streaming-' . uniqid()],
            ['title' => 'Anime Art', 'slug' => 'anime-art-' . uniqid()],
            ['title' => 'Manga Adaptations', 'slug' => 'manga-adaptations-' . uniqid()],
            ['title' => 'Anime News', 'slug' => 'anime-news-' . uniqid()],
            ['title' => 'Anime Trivia', 'slug' => 'anime-trivia-' . uniqid()],
            ['title' => 'Anime Culture', 'slug' => 'anime-culture-' . uniqid()],
        ];

        Tag::insert($tags);
    }
}
