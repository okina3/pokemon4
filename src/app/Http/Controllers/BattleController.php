<?php

namespace App\Http\Controllers;

use App\Http\Requests\BattleRequest;
use App\Models\Battle;
use App\Models\BattleEnvs;
use App\Models\Envs;
use App\Models\OppSelect;
use App\Models\OppTeam;
use App\Models\PlayerSelect;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BattleController extends Controller
{
    public function index()
    {
        // 全バトルデータを取得
        $all_battle = Battle::with(['oppTeams', 'oppSelects', 'playerSelects', 'envs'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // 全環境を取得
        $all_envs = Envs::where('user_id', Auth::id())
            ->get();

        return view('battles.index', compact('all_battle', 'all_envs'));
    }

    public function create()
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::all();

        // 全環境を取得
        $all_envs = Envs::where('user_id', Auth::id())
            ->get();

        return view('battles.create', compact('all_pokemon', 'all_envs'));
    }

    public function store(BattleRequest $request)
    {
        // dd($request->all());
        // バトルデータを保存
        $battle = Battle::create([
            'user_id' => Auth::id(),
            'rank' => $request->rank,
            'judgment' => $request->judgment,
            'comment' => $request->comment,
        ]);

        // 相手のチームをバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opp_teams as $opp_team) {
            Battle::findOrFail($battle->id)->oppTeams()->attach($opp_team);
        }

        // 相手の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opp_selects as $opp_select) {
            Battle::findOrFail($battle->id)->oppSelects()->attach($opp_select);
        }

        // 自分の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->player_selects as $player_select) {
            Battle::findOrFail($battle->id)->playerSelects()->attach($player_select);
        }

        // 環境をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->envs as $envs_number) {
            Battle::findOrFail($battle->id)->envs()->attach($envs_number);
        }

        return to_route('index')->with(['message' => 'バトルデータを登録しました。', 'status' => 'info']);
    }

    public function show(int $id)
    {
        // 選択した、バトルデータを取得
        $select_battle = Battle::with(['oppTeams', 'oppSelects', 'playerSelects', 'envs'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('battles.show', compact('select_battle'));
    }

    public function edit(int $id)
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::all();

        // 全環境を取得
        $all_envs = Envs::where('user_id', Auth::id())
            ->get();

        // 選択したバトルデータを取得
        $select_battle = Battle::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        // 選択したバトルデータに紐づいた相手のチームidを取得
        $opp_teams = [];
        foreach ($select_battle->oppTeams as $opp_team) {
            $opp_teams[] = $opp_team->id;
        }

        // 選択したバトルデータに紐づいた相手の選出idを取得
        $opp_selects = [];
        foreach ($select_battle->oppSelects as $opp_select) {
            $opp_selects[] = $opp_select->id;
        }

        // 選択したバトルデータに紐づいた自分の選出idを取得
        $player_selects = [];
        foreach ($select_battle->playerSelects as $player_select) {
            $player_selects[] = $player_select->id;
        }

        // 選択したバトルデータに紐づいた環境idを取得
        $envs = [];
        foreach ($select_battle->envs as $env) {
            $envs[] = $env->id;
        }

        return view(
            'battles.edit',
            compact('all_pokemon', 'all_envs', 'select_battle', 'opp_teams', 'opp_selects', 'player_selects', 'envs')
        );
    }

    public function update(BattleRequest $request)
    {
        // dd($request->all());
        // バトルデータを更新
        $battle = Battle::where('id', $request->battleId)
            ->where('user_id', Auth::id())
            ->first();
        $battle->rank = $request->rank;
        $battle->judgment = $request->judgment;
        $battle->comment = $request->comment;
        $battle->save();

        // 一旦バトルデータと相手のチームを紐付けた中間デーブルのデータを削除
        OppTeam::where('battle_id', $request->battleId)->delete();
        // 一旦バトルデータと相手の選出を紐付けた中間デーブルのデータを削除
        OppSelect::where('battle_id', $request->battleId)->delete();
        // 一旦バトルデータと自分の選出を紐付けた中間デーブルのデータを削除
        PlayerSelect::where('battle_id', $request->battleId)->delete();
        // 一旦バトルデータと環境を紐付けた中間デーブルのデータを削除
        BattleEnvs::where('battle_id', $request->battleId)->delete();

        // 相手のチームをバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opp_teams as $opp_team) {
            Battle::findOrFail($battle->id)->oppTeams()->attach($opp_team);
        }

        // 相手の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opp_selects as $opp_select) {
            Battle::findOrFail($battle->id)->oppSelects()->attach($opp_select);
        }

        // 自分の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->player_selects as $player_select) {
            Battle::findOrFail($battle->id)->playerSelects()->attach($player_select);
        }

        // 環境をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->envs as $envs_number) {
            Battle::findOrFail($battle->id)->envs()->attach($envs_number);
        }

        return to_route('index')->with(['message' => 'バトルデータを更新しました。', 'status' => 'info']);
    }

    public function destroy(Request $request)
    {
        // 選択したバトルデータを削除
        Battle::where('id', $request->battleId)
            ->where('user_id', Auth::id())
            ->delete();

        return to_route('index')->with(['message' => 'バトルデータを削除しました。', 'status' => 'alert']);
    }
}
