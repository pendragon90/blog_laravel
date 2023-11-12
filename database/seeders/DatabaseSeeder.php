<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
        ]);
        \App\Models\User::factory(150)->create();
        \App\Models\Post::factory(50)->create();
        \App\Models\PostTag::factory(70)->create();
        \App\Models\Like::factory(500)->create();
        // \App\Models\Comment::factory(80)->create();
        // \App\Models\Reply::factory(150)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
