<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvsRequest;
use App\Models\Envs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EnvsController extends Controller
{
    /**
     * 環境の一覧を表示するメソッド。
     * @return View
     */
    public function index(): View
    {
        // 全環境を取得
        $all_envs = Envs::where('user_id', Auth::id())
            ->get();

        return view('envs.index', compact('all_envs'));
    }

    /**
     * 環境を保存するメソッド。
     * @param EnvsRequest $request
     * @return RedirectResponse
     */
    public function store(EnvsRequest $request): RedirectResponse
    {
        // 環境が重複していないか調べる
        $envs_exists = Envs::where('name', $request->new_envs)
            ->where('user_id', Auth::id())
            ->exists();

        // 環境が、重複していなれば、環境を保存
        if (!empty($request->new_envs) && !$envs_exists) {
            Envs::create([
                'name' => $request->new_envs,
                'user_id' => Auth::id()
            ]);
        }

        return to_route('envs.index')->with(['message' => '環境を登録しました。', 'status' => 'info']);
    }

    /**
     * 環境を削除するメソッド。
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 環境を複数まとめて削除
        foreach ($request->envs as $envs) {
            Envs::where('id', $envs)
                ->where('user_id', Auth::id())
                ->delete();
        }
        return to_route('envs.index')->with(['message' => '環境を削除しました。', 'status' => 'alert']);
    }
}
