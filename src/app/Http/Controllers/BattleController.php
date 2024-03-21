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
        $all_battle = Battle::with(['opponentTeams', 'opponentSelections', 'playerSelects', 'environments'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // 全環境を取得
        $all_environments = Envs::where('user_id', Auth::id())
            ->get();

        return view('battles.index', compact('all_battle', 'all_environments'));
    }

    public function create()
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::all();

        // 全環境を取得
        $all_environments = Envs::where('user_id', Auth::id())
            ->get();

        return view('battles.create', compact('all_pokemon', 'all_environments'));
    }

    public function store(BattleRequest $request)
    {
        dd($request->all());
        // バトルデータを保存
        $battle = Battle::create([
            'user_id' => Auth::id(),
            'rank' => $request->rank,
            'judgment' => $request->judgment,
            'comment' => $request->comment,
        ]);

        // 相手のチームをバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opponent_teams as $opponent_team) {
            Battle::findOrFail($battle->id)->opponentTeams()->attach($opponent_team);
        }

        // 相手の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opponent_selections as $opponent_selection) {
            Battle::findOrFail($battle->id)->opponentSelections()->attach($opponent_selection);
        }

        // 自分の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->player_selects as $player_select) {
            Battle::findOrFail($battle->id)->playerSelects()->attach($player_select);
        }

        // 環境をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->environments as $environment_number) {
            Battle::findOrFail($battle->id)->environments()->attach($environment_number);
        }

        return to_route('index')->with(['message' => 'バトルデータを登録しました。', 'status' => 'info']);
    }

    public function show(int $id)
    {
        // 選択した、バトルデータを取得
        $select_battle = Battle::with(['opponentTeams', 'opponentSelections', 'playerSelects', 'environments'])
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
        $all_environments = Envs::where('user_id', Auth::id())
            ->get();

        // 選択したバトルデータを取得
        $select_battle = Battle::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        // 選択したバトルデータに紐づいた相手のチームidを取得
        $opp__teams = [];
        foreach ($select_battle->opponentTeams as $opp_team) {
            $opp_teams[] = $opp_team->id;
        }

        // 選択したバトルデータに紐づいた相手の選出idを取得
        $opp_selections = [];
        foreach ($select_battle->opponentSelections as $opp_selection) {
            $opp_selections[] = $opp_selection->id;
        }

        // 選択したバトルデータに紐づいた自分の選出idを取得
        $player_selects = [];
        foreach ($select_battle->playerSelects as $player_select) {
            $player_selects[] = $player_select->id;
        }

        // 選択したバトルデータに紐づいた環境idを取得
        $environments = [];
        foreach ($select_battle->environments as $environment) {
            $environments[] = $environment->id;
        }

        return view(
            'battles.edit',
            compact('all_pokemon', 'all_environments', 'select_battle', 'opp_teams', 'opp_selections', 'player_selects', 'environments')
        );
    }

    public function update(Request $request)
    {
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
        foreach ($request->opponent_teams as $opponent_team) {
            Battle::findOrFail($battle->id)->opponentTeams()->attach($opponent_team);
        }

        // 相手の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->opponent_selections as $opponent_selection) {
            Battle::findOrFail($battle->id)->opponentSelections()->attach($opponent_selection);
        }

        // 自分の選出をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->player_selects as $player_select) {
            Battle::findOrFail($battle->id)->playerSelects()->attach($player_select);
        }

        // 環境をバトルデータに紐付けて中間テーブルに保存
        foreach ($request->environments as $environment_number) {
            Battle::findOrFail($battle->id)->environments()->attach($environment_number);
        }

        return to_route('index')->with(['message' => 'バトルデータを更新しました。', 'status' => 'info']);
    }

    public function destroy(Request $request)
    {
        // 選択したメモを削除
        Battle::where('id', $request->battleId)
        ->where('user_id', Auth::id())
        ->delete();

        return to_route('index')->with(['message' => 'バトルデータを削除しました。', 'status' => 'alert']);
    }
}
