<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::create([
            'name' => 'client',
            'email' => 'client@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Authenticated_Client');

        User::create([
            'name'=>'artisan',
            'email'=>'artisan@gmail.com',
            'password'=>bcrypt('12345678')
        ])->assignRole('Artisan');


        // Generates 10 fake users using the User model factory and saves them to the database
        User::factory(10)->create();

    }
}
