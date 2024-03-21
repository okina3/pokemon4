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
                'created_at' => '2022/01/01/ 11:11:11'
            ],
            [
                'name' => 'フシギソウ',
                'created_at' => '2022/01/01/ 11:11:12'
            ],
            [
                'name' => 'フシギバナ',
                'created_at' => '2022/01/01/ 11:11:13'
            ],
            [
                'name' => 'ヒトガゲ',
                'created_at' => '2022/01/01/ 11:11:14'
            ],
            [
                'name' => 'リザード',
                'created_at' => '2022/01/01/ 11:11:15'
            ],
            [
                'name' => 'リザードン',
                'created_at' => '2022/01/01/ 11:11:16'
            ],
            [
                'name' => 'ゼニガメ',
                'created_at' => '2022/01/01/ 11:11:17'
            ],
            [
                'name' => 'カメール',
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'カメックス',
                'created_at' => '2022/01/01/ 11:11:19'
            ],
        ]);
    }
}
