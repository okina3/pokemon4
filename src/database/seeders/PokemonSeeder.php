<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pokemon')->insert([
            [
                'name' => 'フシギダネ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:11'
            ],
            [
                'name' => 'フシギソウ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:12'
            ],
            [
                'name' => 'フシギバナ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:13'
            ],
            [
                'name' => 'ヒトガゲ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:14'
            ],
            [
                'name' => 'リザード',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:15'
            ],
            [
                'name' => 'リザードン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:16'
            ],
            [
                'name' => 'ゼニガメ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:17'
            ],
            [
                'name' => 'カメール',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'カメックス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
        ]);
    }
}
