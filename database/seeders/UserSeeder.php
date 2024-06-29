<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Ecommerce',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rahasia'),
            'isAdmin' => 1,
        ]);

        User::create([
            'name' => 'Member Ecommerce',
            'email' => 'member@gmail.com',
            'password' => bcrypt('rahasia'),
            'isAdmin' => 0,
        ]);

    }
}
