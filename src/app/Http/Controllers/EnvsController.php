<?php

namespace App\Http\Controllers;

use App\Models\Envs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnvsController extends Controller
{
    /**
     * 環境の一覧を表示するメソッド。
     * @return View
     */
    public function index()
    {
        // 全環境を取得
        $all_environments = Envs::where('user_id', Auth::id())
            ->get();

        return view('environments.index', compact('all_environments'));
    }

    /**
     * 環境を保存するメソッド。
     */
    public function store(Request $request)
    {
        // 環境が重複していないか調べる
        $environment_exists = Envs::where('name', $request->new_environment)
            ->where('user_id', Auth::id())
            ->exists();

        // 環境が、重複していなれば、環境を保存
        if (!empty($request->new_environment) && !$environment_exists) {
            Envs::create([
                'name' => $request->new_environment,
                'user_id' => Auth::id()
            ]);
        }

        return to_route('environment.index')->with(['message' => '環境を登録しました。', 'status' => 'info']);
    }

    /**
     * 環境を削除するメソッド。
     */
    public function destroy(Request $request)
    {
        // 環境を複数まとめて削除
        foreach ($request->tags as $tag) {
            Envs::where('id', $tag)
                ->where('user_id', Auth::id())
                ->delete();
        }
        return to_route('environment.index')->with(['message' => '環境を削除しました。', 'status' => 'alert']);
    }
}
