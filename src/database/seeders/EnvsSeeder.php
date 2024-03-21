<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('envs')->insert([
            [
                'name' => 'ヒトカゲ入り',
                'user_id' => '1',
            ],
            [
                'name' => 'リザードン入り',
                'user_id' => '1',
            ],
            [
                'name' => 'カメックス入り',
                'user_id' => '1',
            ],
            [
                'name' => 'フジキバナ入り',
                'user_id' => '1',
            ],
            [
                'name' => 'カメックス + フジキバナ入り',
                'user_id' => '1',
            ],
            [
                'name' => 'その他',
                'user_id' => '1',
            ],
        ]);
    }
}
