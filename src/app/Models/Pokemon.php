<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Battleモデルとの多対多のリレーションを定義（相手の選出候補）
     * @return BelongsToMany
     */
    public function oppTeams(): BelongsToMany
    {
        return $this->belongsToMany(Battle::class, 'opp_teams');
    }

    /**
     * Battleモデルとの多対多のリレーションを定義（相手の選出）
     * @return BelongsToMany
     */
    public function oppSelects(): BelongsToMany
    {
        return $this->belongsToMany(Battle::class, 'opp_selects');
    }

    /**
     * Battleモデルとの多対多のリレーションを定義（自分の選出）
     * @return BelongsToMany
     */
    public function playerSelects(): BelongsToMany
    {
        return $this->belongsToMany(Battle::class, 'player_selects');
    }

    /**
     * 自分自身の、全てのポケモンを取得する為のスコープ。
     * @param Builder $query
     * @return void
     */
    public function scopeAvailableAllPokemon(Builder $query): void
    {
        $query->select('id', 'name', 'user_id')
            ->where('user_id', Auth::id());
    }

    /**
     * 自分自身の、選択したバトルデータを取得する為のスコープ。
     * @param Builder $query
     * @param int $id
     * @return void
     */
    public function scopeAvailableSelectPokemon(Builder $query, int $id): void
    {
        $query->where('id', $id)
            ->where('user_id', Auth::id());
    }

    /**
     * ポケモンをDBに保存する為のスコープ。
     * @param Builder $query
     * @param string $request_name
     * @return void
     */
    public function scopeAvailableCreatePokemon(Builder $query, string $request_name): void
    {
        $query->create([
            'name' => $request_name,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * 検索したポケモンを表示するの為のスコープ。
     * @param $query
     * @param $keyword
     * @return void
     */
    public function scopeSearchKeyword($query, $keyword): void
    {
        // もしポケモンの検索があったら
        if (!is_null($keyword)) {
            // 全角スペースを半角に変換
            $spaceConvert = mb_convert_kana($keyword, 's');
            // 空白で区切る
            $keywords = preg_split('/\s+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);
            // 単語をループで回す
            foreach ($keywords as $word) {
                $query->where('pokemon.name', 'like', '%' . $word . '%');
            }
        }
    }
}
