<x-app-layout>
    <div class="max-w-screen-lg mx-auto">
        {{-- フラッシュメッセージ --}}
        <x-common.flash-message status="session('status')"/>
        {{-- ポケモンの検索エリア --}}
        <section class="mb-5 px-3 py-1 text-gray-600 border border-gray-400 rounded-lg bg-gray-200">
            <form action="{{ route('pokemon.index') }}" method="get">
                <div class="sm:flex items-center">
                    <div class="heading ">ポケモンを検索</div>
                    <div class="hidden sm:block">・・・</div>
                    {{-- ポケモンの名前を入力 --}}
                    <input class="py-2 w-60 border border-gray-500 rounded-lg" name="keyword"
                           placeholder="ポケモンの名前を入力">
                    {{-- 検索するボタン --}}
                    <button class="ml-2 btn bg-blue-800 hover:bg-blue-700">検索する</button>
                </div>
            </form>
        </section>
        {{-- 登録ポケモン一覧エリア --}}
        <section class="text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
            {{-- タイトル --}}
            <div class="heading_bg py-2 flex justify-between items-center">
                <h1 class="heading">ポケモン一覧</h1>
                {{-- 新規作成ボタン --}}
                <button class="btn bg-blue-800 hover:bg-blue-700"
                        onclick="location.href='{{ route('pokemon.create') }}'">
                    ポケモン新規登録
                </button>
            </div>
            {{-- ポケモン一覧 --}}
            <div class="p-2 h-[73vh] overflow-y-scroll overscroll-none">
                @foreach ($all_pokemon as $pokemon)
                    <div class="mb-2 p-2 flex justify-between items-center border border-gray-400 rounded-lg">
                        <div class="flex items-center">
                            {{-- ポケモンの名前 --}}
                            <p class="w-52 sub_heading truncate">{{ $pokemon->name }}</p>
                        </div>
                        {{-- ボタンエリア --}}
                        <div class="flex justify-end text-white">
                            {{-- 詳細ボタン --}}
                            <button class="btn mr-3 bg-gray-800 hover:bg-gray-700"
                                    onclick="location.href='{{ route('pokemon.show', ['pokemon' => $pokemon->id]) }}'">
                                詳細
                            </button>
                            {{-- 編集ボタン --}}
                            <button class="btn mr-3 bg-blue-800 hover:bg-blue-700"
                                    onclick="location.href='{{ route('pokemon.edit', ['pokemon' => $pokemon->id]) }}'">
                                編集
                            </button>
                            {{-- 削除ボタン --}}
                            <form onsubmit="return deleteCheck()" action="{{ route('pokemon.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                {{-- 選択されているポケモンのidを取得 --}}
                                <input type="hidden" name="pokemonId" value="{{ $pokemon->id }}">
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
    <script>
        'use strict'

        // 削除のアラート
        function deleteCheck() {
            const RESULT = confirm('本当にポケモンを削除してもいいですか?');
            if (!RESULT) alert("削除をキャンセルしました");
            return RESULT;
        }
    </script>
</x-app-layout>
