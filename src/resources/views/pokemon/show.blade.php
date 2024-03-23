<x-app-layout>
    <section class="max-w-screen-lg mx-auto text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
        {{-- メモの詳細ページのタイトル --}}
        <h1 class="heading heading_bg">メモ詳細</h1>
        {{-- 選択したメモの詳細を表示するエリア --}}
        <div class="p-3">
            {{-- メモの詳細を表示エリア --}}
            <div class="mb-3">
                {{-- 選択したメモのタイトルを表示 --}}
                <div class="mb-5">
                    <h2 class="sub_heading mb-1">ポケモンの名前</h2>
                    <p class="p-2 border border-gray-500 rounded bg-white">{{ $select_pokemon->name }}</p>
                </div>
                {{-- 戻るボタン --}}
                <div class="mb-2 flex justify-end">
                    <button onclick="location.href='{{ route('pokemon.index') }}'"
                            class="btn bg-gray-800 hover:bg-gray-700">
                        戻る
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
