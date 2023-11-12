<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Pendragon', 'role_id' => 1, 'email' => 'pendragon21698@gmail.com', 'password' => bcrypt('daffa123'), 'created_at' => now(), 'email_verified_at' => now()],
            ['name' => 'Anna', 'role_id' => 2, 'email' => 'anna123@gmail.com', 'password' => bcrypt('daffa123'), 'created_at' => now(), 'email_verified_at' => now()],
            ['name' => 'Tina', 'role_id' => 2, 'email' => 'tina123@gmail.com', 'password' => bcrypt('daffa123'), 'created_at' => now(), 'email_verified_at' => now()],
        ];

        User::insert($users);
    }
}
