<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Auth;

class PokemonController extends Controller
{
    public function index()
    {
        // 全ポケモンを取得
        $all_pokemon = Pokemon::where('user_id', Auth::id())
            ->get();

        return view('pokemon.index', compact('all_pokemon'));
    }

    public function create()
    {

        return view('pokemon.create');
    }

    public function store(Request $request)
    {
        // ポケモンを保存
        Pokemon::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return to_route('pokemon.index')->with(['message' => 'ポケモンを登録しました。', 'status' => 'info']);
    }

    public function show($id)
    {
        // 選択したポケモンのデータを取得
        $select_pokemon = Pokemon::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('pokemon.show', compact('select_pokemon'));
    }

    public function edit($id)
    {
        // 選択したポケモンのデータを取得
        $select_pokemon = Pokemon::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('pokemon.edit', compact('select_pokemon'));
    }


    public function update(Request $request)
    {
        // ポケモンを更新
        $pokemon = Pokemon::where('id', $request->pokemonId)
            ->where('user_id', Auth::id())
            ->first();
        $pokemon->name = $request->name;
        $pokemon->save();

        return to_route('pokemon.index')->with(['message' => 'ポケモンを更新しました。', 'status' => 'info']);
    }

    public function destroy(Request $request)
    {
        // 選択したポケモンを削除
        Pokemon::where('id', $request->pokemonId)
            ->where('user_id', Auth::id())
            ->delete();

        return to_route('pokemon.index')->with(['message' => 'ポケモンを削除しました。', 'status' => 'alert']);
    }
}
