<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'ポケモン',
            'email' => 'test@test1',
            'password' => Hash::make('laravel321'),
            'created_at' => '2024/01/05/ 11:11:11'
        ]);
    }
}
