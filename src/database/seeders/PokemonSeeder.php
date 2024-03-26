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
                'name' => 'なし',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:11'
            ],
            [
                'name' => 'カイリュー',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:11'
            ],
            [
                'name' => 'ハバタクカミ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:12'
            ],
            [
                'name' => 'ガチグマ(ア)',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:13'
            ],
            [
                'name' => 'サーフゴー',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:14'
            ],
            [
                'name' => 'ディンルー',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:15'
            ],
            [
                'name' => 'ランドロス(霊)',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:16'
            ],
            [
                'name' => 'ウーラオス(不)',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:17'
            ],
            [
                'name' => '水ウーラオス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:17'
            ],
            [
                'name' => '悪ウーラオス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:17'
            ],
            [
                'name' => '炎オーガポン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => '水オーガポン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => '岩オーガポン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ブリジュラス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
            [
                'name' => 'ハッサム',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
            [
                'name' => 'タケルライコ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
            [
                'name' => 'イーユイ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
            [
                'name' => 'キョジオーン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
            [
                'name' => 'テツノツツミ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:19'
            ],
            [
                'name' => 'グライオン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'アシレーヌ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'トドロクツキ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'イダイトウ(オス)',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ドオー',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ラティオス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ラティアス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'オオニューラ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ママンボウ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'キュウコン(ア)',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'エンティ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ヘイラッシャ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'キラフロル',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ドヒドイテ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'テツノカイナ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'モロバレル',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ゴリランダー',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'コノヨザル',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ウガツホムラ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'テツノカシラ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ジャローダ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'キノガッザ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ポリゴン２',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'テツノドクガ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'エルフーン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'チオンジェン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'マスカーニャ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'カバルドン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'スイクン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'メタグロス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ヒードラン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'オーロンゲ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'イエッサン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'レジエレキ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'エアームド',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ロトム(火)',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'テツノブジン',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'セグレウブ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'マシマシラ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'エンペルト',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'マスカーニャ',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'キチキギス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
            [
                'name' => 'ギャラドス',
                'user_id' => 1,
                'created_at' => '2022/01/01/ 11:11:18'
            ],
        ]);
    }
}
