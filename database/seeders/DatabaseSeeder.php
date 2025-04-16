<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserModel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserModel::create([
            'nama' => 'Test User',
            'email' => 'fadil@gmail.com',
            'no_hp' => '4567823673',
            'password' => Hash::make('263873')
        ]);
    }
}
