<x-app-layout>
    <div class="max-w-screen-xl mx-auto">
        {{-- フラッシュメッセージ --}}
        <x-common.flash-message status="session('status')"/>
        <div class="mb-2 md:flex justify-between">
            {{-- 環境検索の表示エリア --}}
            <section class="mb-2 mr-2 md:mb-0 md:w-1/4 text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
                {{-- タイトル --}}
                <h1 class="heading heading_bg">環境から検索</h1>
                {{-- 環境の検索 --}}
                <div class="p-3 h-[15vh] md:h-[85vh] overflow-y-scroll overscroll-none">
                    <div class="mb-2 hover:font-semibold"><a href="/">全てのバトルデータを表示</a></div>
                    {{-- 環境一覧 --}}
                    @foreach ($all_envs as $envs)
                        <a class="mb-1 block hover:font-semibold" href="/?envs={{ $envs->id }}">
                            {{ $envs->name }}
                        </a>
                    @endforeach
                </div>
            </section>
            {{-- 登録ポケモン一覧の表示エリア --}}
            <section class=" md:w-3/4 text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
                {{-- タイトル --}}
                <div class="heading_bg py-2 flex justify-between items-center">
                    <h1 class="heading">バトルデータ一覧</h1>
                    {{-- ポケモン新規作成ボタン --}}
                    <button class="btn bg-blue-800 hover:bg-blue-700" onclick="location.href='{{ route('create') }}'">
                        バトルデータ新規登録
                    </button>
                </div>
                {{-- ポケモン一覧 --}}
                <div class="p-2 h-[73vh] overflow-y-scroll overscroll-none">
                    @foreach ($all_battle as $battle)
                        <div class="mb-2 p-2 flex justify-between items-center border border-gray-400 rounded-lg">
                            <div class="font-semibold">
                                <div class="mb-1 flex">
                                    {{-- 相手の順位 --}}
                                    <p class="font-normal">{{ number_format($battle->rank) }} 位</p>
                                    {{-- 勝敗 --}}
                                    <div class="ml-3">
                                        @if ($battle->judgment === 1)
                                            <p>（ <span class="text-red-600">勝ち</span> ）</p>
                                        @endif
                                        @if ($battle->judgment === 0)
                                            <p>（ <span class="text-blue-700">負け</span> ）</p>
                                        @endif
                                        @if ($battle->judgment === 2)
                                            <p>（ <span class="text-red-600">運勝ち</span> ）</p>
                                        @endif
                                        @if ($battle->judgment === 3)
                                            <p>（ <span class="text-blue-700">運負け</span> ）</p>
                                        @endif
                                    </div>
                                </div>
                                {{-- 相手のチーム --}}
                                <div class="mb-2 ">
                                    <span>相手チーム<span class="font-normal">・・・</span></span>
                                    @foreach ($battle->oppTeams as $opp_team)
                                        <span
                                            class="mr-2 py-0.5 px-1 border border-gray-500 rounded">{{ $opp_team->name }}</span>
                                    @endforeach
                                </div>
                                {{-- 実際の選出候補 --}}
                                <div class="mb-2">
                                    <span>選出（相手）<span class="font-normal">・・</span></span>
                                    @foreach ($battle->oppSelects as $opp_Select)
                                        <span
                                            class="mr-2 py-0.5 px-1 border border-gray-500 rounded">{{ $opp_Select->name }}</span>
                                    @endforeach
                                </div>
                                {{-- 自分の選出候補 --}}
                                <div class="mb-2">
                                    <span>選出（自分）<span class="font-normal">・・</span></span>
                                    @foreach ($battle->playerSelects as $player_select)
                                        <span
                                            class="mr-2 py-0.5 px-1 border border-gray-500 rounded">{{ $player_select->name }}</span>
                                    @endforeach
                                </div>
                                {{-- 環境 --}}
                                <div class="mb-2">
                                    <span>環境<span class="font-normal">・・・・・・</span></span>
                                    @foreach ($battle->envs as $envs)
                                        <span class="border-b border-gray-500">{{ $envs->name }}</span>、
                                    @endforeach
                                </div>
                            </div>
                            {{-- ボタンエリア --}}
                            <div class="text-white">
                                {{-- 詳細ボタン --}}
                                <button onclick="location.href='{{ route('show', ['battle' => $battle->id]) }}'"
                                        class="mb-2 px-3 py-1 rounded bg-gray-800 hover:bg-gray-700">
                                    詳細
                                </button>
                                {{-- 編集ボタン --}}
                                <button onclick="location.href='{{ route('edit', ['battle' => $battle->id]) }}'"
                                        class="mb-2 py-1 px-3 block rounded bg-blue-800 hover:bg-blue-700">
                                    編集
                                </button>
                                {{-- 削除ボタン --}}
                                <form onsubmit="return deleteCheck()" action="{{ route('destroy') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    {{-- 選択されているメモのidを取得 --}}
                                    <input type="hidden" name="battleId" value="{{ $battle->id }}">
                                    <button type="submit" class="py-1 px-3 rounded bg-red-600 hover:bg-red-500">
                                        削除
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    <script>
        'use strict'

        // 削除のアラート
        function deleteCheck() {
            const RESULT = confirm('本当にバトルデータを削除してもいいですか?');
            if (!RESULT) alert("削除をキャンセルしました");
            return RESULT;
        }
    </script>
</x-app-layout>
