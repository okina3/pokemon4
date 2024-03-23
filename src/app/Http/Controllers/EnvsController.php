<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvsRequest;
use App\Models\Envs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $all_envs = Envs::availableAllEnvs()->get();

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
        $envs_exists = Envs::availableCheckDuplicateEnvs($request->new_envs)->exists();
        // 環境が、重複していなれば、環境を保存
        if (!empty($request->new_envs) && !$envs_exists) {
            Envs::availableCreateEnvs($request->new_envs);
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
            Envs::availableSelectEnvs($envs)->delete();
        }
        return to_route('envs.index')->with(['message' => '環境を削除しました。', 'status' => 'alert']);
    }
}
