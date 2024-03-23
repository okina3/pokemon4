<?php

namespace App\Services;

use App\Models\Battle;
use App\Models\BattleEnvs;
use App\Models\Envs;
use App\Models\OppSelect;
use App\Models\OppTeam;
use App\Models\PlayerSelect;

class BattleService
{
    /**
     * 全バトルデータ、または検索されたバトルデータを一覧表示するメソッド。
     * @return mixed
     */
    public static function searchBattles(): mixed
    {
        // 全バトルデータ、または検索されたバトルデータを表示する
        $get_url = \Request::query('envs');
        // もしクエリパラメータがあれば、環境から絞り込む
        if (!empty($get_url)) {
            // 絞り込んだ環境にリレーションされたバトルデータを含む、環境を取得
            $url_envs = Envs::with('battles')->availableSelectEnvs($get_url)->first();
            // 環境にリレーションされたバトルデータを取得
            $all_battle = $url_envs->battles;
        } else {
            // 全バトルデータを取得
            $all_battle = Battle::availableAllBattle()->orderBy('created_at', 'desc')->get();
        }
        return $all_battle;
    }

    /**
     * バトルデータに紐づいた、相手のチーム、相手の選出、自分の選出、環境を、中間テーブルを保存するメソッド
     * @param $request
     * @param int $battle_id
     * @return void
     */
    public static function attachBattleRecords($request, int $battle_id): void
    {
        // 相手のチームを、バトルデータに紐付けて中間テーブルに保存
        foreach ($request->opp_teams as $opp_team) {
            Battle::findOrFail($battle_id)->oppTeams()->attach($opp_team);
        }

        // 相手の選出を、バトルデータに紐付けて中間テーブルに保存
        foreach ($request->opp_selects as $opp_select) {
            Battle::findOrFail($battle_id)->oppSelects()->attach($opp_select);
        }

        // 自分の選出を、バトルデータに紐付けて中間テーブルに保存
        foreach ($request->player_selects as $player_select) {
            Battle::findOrFail($battle_id)->playerSelects()->attach($player_select);
        }

        // 環境を、バトルデータに紐付けて中間テーブルに保存
        foreach ($request->envs as $envs_number) {
            Battle::findOrFail($battle_id)->envs()->attach($envs_number);
        }
    }

    /**
     * 選択したバトルデータに紐づいた、相手のチームidを取得
     * @param $select_battle
     * @return array
     */
    public static function oppTeamId($select_battle): array
    {
        $opp_teams = [];
        foreach ($select_battle->oppTeams as $opp_team) {
            $opp_teams[] = $opp_team->id;
        }
        return $opp_teams;
    }

    /**
     * 選択したバトルデータに紐づいた、相手の選出idを取得
     * @param $select_battle
     * @return array
     */
    public static function oppSelectId($select_battle): array
    {
        $opp_selects = [];
        foreach ($select_battle->oppSelects as $opp_select) {
            $opp_selects[] = $opp_select->id;
        }
        return $opp_selects;
    }

    /**
     * 選択したバトルデータに紐づいた、自分の選出idを取得
     * @param $select_battle
     * @return array
     */
    public static function playerSelectId($select_battle): array
    {
        $player_selects = [];
        foreach ($select_battle->playerSelects as $player_select) {
            $player_selects[] = $player_select->id;
        }
        return $player_selects;
    }

    /**
     * 選択したバトルデータに紐づいた、環境idを取得
     * @param $select_battle
     * @return array
     */
    public static function envsId($select_battle): array
    {
        $envs = [];
        foreach ($select_battle->envs as $env) {
            $envs[] = $env->id;
        }
        return $envs;
    }

    /**
     * バトルデータに、紐付いた中間デーブルのデータを全て削除
     * @param int $battleId
     * @return void
     */
    public static function relationDelete(int $battleId): void
    {
        // バトルデータと相手のチームを紐付けた中間デーブルのデータを削除
        OppTeam::where('battle_id', $battleId)->delete();
        // バトルデータと相手の選出を紐付けた中間デーブルのデータを削除
        OppSelect::where('battle_id', $battleId)->delete();
        // バトルデータと自分の選出を紐付けた中間デーブルのデータを削除
        PlayerSelect::where('battle_id', $battleId)->delete();
        // バトルデータと環境を紐付けた中間デーブルのデータを削除
        BattleEnvs::where('battle_id', $battleId)->delete();
    }
}

;
