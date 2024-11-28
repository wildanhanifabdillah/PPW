<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'Name' => 'Admin',
                'Email' => 'admin@mail.com',
                'Password' => Hash::make('password'),
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name' => 'User',
                'Email' => 'user@mail.com',
                'Password' => Hash::make('password'), 
                'level' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name' => 'Agus Mulyadi',
                'Email' => 'review@mail.com',
                'Password' => Hash::make('password'),
                'level' => 'internal_reviewer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
