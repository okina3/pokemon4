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
}
