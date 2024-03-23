<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

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

    /**
     * 自分自身の、全ての環境を取得する為のスコープ。
     * @param Builder $query
     * @return void
     */
    public function scopeAvailableAllEnvs(Builder $query): void
    {
        $query->select('id', 'name', 'user_id')
            ->where('user_id', Auth::id());
    }

    /**
     * 自分自身の、選択したタグを取得する為のスコープ。
     * @param Builder $query
     * @param int $get_url
     * @return void
     */
    public function scopeAvailableSelectEnvs(Builder $query, int $get_url): void
    {
        $query->where('id', $get_url)
            ->where('user_id', Auth::id());
    }

    /**
     * 環境をDBに保存する為のスコープ。
     * @param Builder $query
     * @param string $request_new_envs
     * @return void
     */
    public function scopeAvailableCreateEnvs(Builder $query, string $request_new_envs): void
    {
        $query->create([
            'name' => $request_new_envs,
            'user_id' => Auth::id()
        ]);
    }

    /**
     * 環境が重複していないか調べる為のスコープ。
     * @param Builder $query
     * @param string $request_new_envs
     * @return void
     */
    public function scopeAvailableCheckDuplicateEnvs(Builder $query, string $request_new_envs): void
    {
        $query->where('name', $request_new_envs)
            ->where('user_id', Auth::id());
    }
}
