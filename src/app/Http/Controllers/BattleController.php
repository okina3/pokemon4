<?php

namespace App\Http\Controllers;

use App\Http\Requests\BattleRequest;
use App\Models\Battle;
use App\Models\Envs;
use App\Models\Pokemon;
use App\Services\BattleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class BattleController extends Controller
{
    /**
     * バトルデータの一覧を表示するメソッド。
     * @return View
     */
    public function index(): View
    {
        // 全バトルデータ、または検索されたバトルデータを一覧表示する
        $all_battle = BattleService::searchBattles();
        // 全環境を取得
        $all_envs = Envs::availableAllEnvs()->get();

        return view('battles.index', compact('all_battle', 'all_envs'));
    }

    /**
     * バトルデータの新規作成画面を表示するメソッド。
     * @return View
     */
    public function create(): View
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::availableAllPokemon()->get();
        // 全環境を取得
        $all_envs = Envs::availableAllEnvs()->get();

        return view('battles.create', compact('all_pokemon', 'all_envs'));
    }

    /**
     * バトルデータを保存するメソッド。
     * @param BattleRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(BattleRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                // バトルデータを保存
                $battle = Battle::create([
                    'user_id' => Auth::id(),
                    'rank' => $request->rank,
                    'judgment' => $request->judgment,
                    'comment' => $request->comment,
                ]);
                // 相手のチーム、相手の選出、自分の選出、環境を、中間テーブルを保存するメソッド
                BattleService::attachBattleRecords($request, $battle->id);
            }, 10);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return to_route('index')->with(['message' => 'バトルデータを登録しました。', 'status' => 'info']);
    }

    /**
     * バトルデータの詳細を表示するメソッド。
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        // 選択した、バトルデータを取得
        $select_battle = Battle::with(['oppTeams', 'oppSelects', 'playerSelects', 'envs'])
            ->availableSelectBattle($id)->first();

        return view('battles.show', compact('select_battle'));
    }

    /**
     * バトルデータの編集画面を表示するメソッド。
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::availableAllPokemon()->get();
        // 全環境を取得
        $all_envs = Envs::availableAllEnvs()->get();
        // 選択したバトルデータを取得
        $select_battle = Battle::availableSelectBattle($id)->first();
        // 選択したバトルデータに紐づいた、相手のチームidを取得
        $opp_teams = BattleService::oppTeamId($select_battle);
        // 選択したバトルデータに紐づいた、相手の選出idを取得
        $opp_selects = BattleService::oppSelectId($select_battle);
        // 選択したバトルデータに紐づいた、自分の選出idを取得
        $player_selects = BattleService::playerSelectId($select_battle);
        // 選択したバトルデータに紐づいた環境idを取得
        $envs = BattleService::envsId($select_battle);

        return view(
            'battles.edit',
            compact('all_pokemon', 'all_envs', 'select_battle', 'opp_teams', 'opp_selects', 'player_selects', 'envs')
        );
    }

    /**
     * バトルデータを更新するメソッド。
     * @param BattleRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(BattleRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                // バトルデータを更新
                $battle = Battle::availableSelectBattle($request->battleId)->first();
                $battle->rank = $request->rank;
                $battle->judgment = $request->judgment;
                $battle->comment = $request->comment;
                $battle->save();
                // バトルデータに紐付いた、中間デーブルのデータを全て削除
                BattleService::relationDelete($request->battleId);
                // 相手のチーム、相手の選出、自分の選出、環境を、中間テーブルを保存するメソッド
                BattleService::attachBattleRecords($request, $battle->id);
            }, 10);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return to_route('index')->with(['message' => 'バトルデータを更新しました。', 'status' => 'info']);
    }

    /**
     * バトルデータを削除するメソッド。
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 選択したバトルデータを削除
        Battle::availableSelectBattle($request->battleId)->delete();

        return to_route('index')->with(['message' => 'バトルデータを削除しました。', 'status' => 'alert']);
    }
}
