<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Anime', 'slug' => 'anime-' . uniqid()],
            ['title' => 'Programming', 'slug' => 'programming-' . uniqid()],
            ['title' => 'Game', 'slug' => 'game-' . uniqid()],
            ['title' => 'Berita', 'slug' => 'berita-' . uniqid()],
        ];
        Category::insert($categories);
    }
}
