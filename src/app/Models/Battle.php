<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Battle extends Model
{
    use HasFactory;

    protected $fillable = [
        'rank',
        'user_id',
        'judgment',
        'comment',
    ];

    /**
     * Pokemonモデルとの多対多のリレーションを定義（相手の選出候補）
     * @return BelongsToMany
     */
    public function oppTeams(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'opp_teams')
            ->orderByPivot('id', 'asc');
    }

    /**
     * Pokemonモデルとの多対多のリレーションを定義（相手の選出）
     * @return BelongsToMany
     */
    public function oppSelects(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'opp_selects')
            ->orderByPivot('id', 'asc');
    }

    /**
     * Pokemonモデルとの多対多のリレーションを定義（自分の選出）
     * @return BelongsToMany
     */
    public function playerSelects(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'player_selects')
            ->orderByPivot('id', 'asc');
    }

    /**
     * Envsモデルとの多対多のリレーションを定義。
     * @return BelongsToMany
     */
    public function envs(): BelongsToMany
    {
        return $this->belongsToMany(Envs::class, 'battle_envs');
    }

    /**
     * 自分自身の、全てのバトルデータを取得する為のスコープ。
     * @param Builder $query
     * @return void
     */
    public function scopeAvailableAllBattle(Builder $query): void
    {
        // 全バトルデータを取得
        $query->with(['oppTeams', 'oppSelects', 'playerSelects', 'envs'])
            ->where('user_id', Auth::id());
    }

    /**
     * 自分自身の、選択したバトルデータを取得する為のスコープ。
     * @param Builder $query
     * @param int $id
     * @return void
     */
    public function scopeAvailableSelectBattle(Builder $query, int $id): void
    {
        $query->where('id', $id)
            ->where('user_id', Auth::id());
    }
}
