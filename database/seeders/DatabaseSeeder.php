<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password")
        ]);

        User::create([
            "name" => "michael",
            "email" => "maikelsumayouw@gmail.com",
            "password" => bcrypt("sumayouw28")

        ]);
    }
}