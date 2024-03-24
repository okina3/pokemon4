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
                'name' => 'カイリュー入りの対面構築(ガチグマあり+ブリジュなし)',
                'user_id' => '1',
            ],
            [
                'name' => 'カイリュー入りの対面構築(ガチグマ+ブリジュあり)',
                'user_id' => '1',
            ],
            [
                'name' => 'カイリュー入りの対面構築(ガチグマなし)',
                'user_id' => '1',
            ],
            [
                'name' => 'ランド+ガオガエン入りサイクル構築',
                'user_id' => '1',
            ],
            [
                'name' => 'パオジアン + ハバタクカミ',
                'user_id' => '1',
            ],
            [
                'name' => 'その他',
                'user_id' => '1',
            ],
        ]);
    }
}
