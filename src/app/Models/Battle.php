<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function opponentTeams(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'opp_teams')
            ->orderByPivot('id', 'asc');
    }

    /**
     * Pokemonモデルとの多対多のリレーションを定義（相手の選出）
     * @return BelongsToMany
     */
    public function opponentSelections(): BelongsToMany
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
    public function environments(): BelongsToMany
    {
        return $this->belongsToMany(Envs::class, 'battle_envs');
    }
}
