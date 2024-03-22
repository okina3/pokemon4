<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
}
