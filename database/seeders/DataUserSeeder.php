<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_user')->insert([
            'nama' => 'Admin',
            'no_hp' => '081234567890',
            'email' => 'indirokanfadhilah@gmail.com',
            'password' => Hash::make('1234'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
