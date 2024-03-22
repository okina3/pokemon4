<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Models\Pokemon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PokemonController extends Controller
{
    /**
     * ポケモンの一覧を表示するメソッド。
     * @return View
     */
    public function index(): View
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::where('user_id', Auth::id())
            ->get();

        return view('pokemon.index', compact('all_pokemon'));
    }

    /**
     * ポケモンの新規作成画面を表示するメソッド。
     * @return View
     */
    public function create(): View
    {

        return view('pokemon.create');
    }

    /**
     * ポケモンを保存するメソッド。
     * @param PokemonRequest $request
     * @return RedirectResponse
     */
    public function store(PokemonRequest $request): RedirectResponse
    {
        // ポケモンを保存
        Pokemon::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return to_route('pokemon.index')->with(['message' => 'ポケモンを登録しました。', 'status' => 'info']);
    }

    /**
     * ポケモンの詳細を表示するメソッド。
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        // 選択したポケモンのデータを取得
        $select_pokemon = Pokemon::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('pokemon.show', compact('select_pokemon'));
    }

    /**
     * ポケモンの編集画面を表示するメソッド。
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        // 選択したポケモンのデータを取得
        $select_pokemon = Pokemon::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('pokemon.edit', compact('select_pokemon'));
    }

    /**
     * ポケモンを更新するメソッド。
     * @param PokemonRequest $request
     * @return RedirectResponse
     */
    public function update(PokemonRequest $request): RedirectResponse
    {
        // ポケモンを更新
        $pokemon = Pokemon::where('id', $request->pokemonId)
            ->where('user_id', Auth::id())
            ->first();
        $pokemon->name = $request->name;
        $pokemon->save();

        return to_route('pokemon.index')->with(['message' => 'ポケモンを更新しました。', 'status' => 'info']);
    }

    /**
     * ポケモンを削除するメソッド。
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 選択したポケモンを削除
        Pokemon::where('id', $request->pokemonId)
            ->where('user_id', Auth::id())
            ->delete();

        return to_route('pokemon.index')->with(['message' => 'ポケモンを削除しました。', 'status' => 'alert']);
    }
}
