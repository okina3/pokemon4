<x-app-layout>
    <section class="max-w-screen-lg mx-auto text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
        {{-- タイトル --}}
        <h1 class="heading heading_bg">ポケモンの編集</h1>
        {{-- ポケモンを新規登録するエリア --}}
        <div class="p-3">
            <form action="{{ route('pokemon.update') }}" method="post">
                @csrf
                @method('patch')
                {{-- ポケモンの名前を入力 --}}
                <div class="mb-5">
                    <h2 class="sub_heading mb-1">ポケモンの名前</h2>
                    <input class="w-60 rounded" type="text" name="name" value="{{ $select_pokemon->name }}"
                           placeholder="ポケモン名を入力"/>
                    {{-- エラーメッセージ（メモのタイトル） --}}
                    {{-- <x-input-error class="mt-2" :messages="$errors->get('name')"/> --}}
                </div>
                {{-- 選択されているポケモンのidを取得 --}}
                <input type="hidden" name="pokemonId" value="{{ $select_pokemon->id }}">
                {{-- メモの更新ボタン --}}
                <div class="mb-5">
                    <button class="btn bg-blue-800 hover:bg-blue-700" type="submit">更新する</button>
                </div>
            </form>
            {{-- 戻るボタン --}}
            <div class="flex justify-end">
                <button class="btn bg-gray-800 hover:bg-gray-700"
                        onclick="location.href='{{ route('pokemon.index') }}'">
                    戻る
                </button>
            </div>
        </div>
    </section>
</x-app-layout>
