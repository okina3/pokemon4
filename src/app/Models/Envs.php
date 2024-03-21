<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Envs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Battleモデルとの多対多のリレーションを定義。
     * @return BelongsToMany
     */
    public function battles(): BelongsToMany
    {
        return $this->belongsToMany(Battle::class, 'battle_envs');
    }
}
