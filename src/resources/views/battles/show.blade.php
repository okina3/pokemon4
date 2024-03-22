<x-app-layout>
   <section class="min-h-[45vh] text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
      <h1 class="heading heading_bg">メモ詳細</h1>
      {{-- 選択したメモの詳細を表示するエリア --}}
      <div class="p-3">
         {{-- メモの詳細を表示エリア --}}
         <div class="mb-3">
            {{-- 相手の順位を入力 --}}
            <div class="mb-5 flex items-center">
               <h2 class="sub_heading">相手の順位</h2>・・・
               <p class="text-lg border-b border-gray-500">{{ number_format($select_battle->rank) }} 位</p>
            </div>
            {{-- 選択したバトルデータの相手のチーム --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-2">相手のチーム</h2>
               @foreach ($select_battle->oppTeams as $opp_team)
                  <span class="mr-2 p-2 font-semibold border border-gray-500 rounded">{{ $opp_team->name }}</span>
               @endforeach
            </div>
            {{-- 選択したバトルデータの相手の選出 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-2">相手の選出</h2>
               @foreach ($select_battle->oppSelects as $opp_Select)
                  <span class="mr-2 p-2 font-semibold border border-gray-500 rounded">{{ $opp_Select->name }}</span>
               @endforeach
            </div>
            {{-- 選択したバトルデータの自分の選出 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-2">自分の選出</h2>
               @foreach ($select_battle->playerSelects as $player_select)
                  <span class="mr-2 p-2 font-semibold border border-gray-500 rounded">{{ $player_select->name }}</span>
               @endforeach
            </div>
            {{-- 選択したバトルデータの環境を表示 --}}
            <div class="mb-5">
               <h2 class="sub_heading">環境</h2>
               @foreach ($select_battle->envs as $envs)
                  <div class="inline mr-3">
                     <input class="mb-1 rounded" type="checkbox" checked disabled />
                     <span class="font-semibold border-b border-gray-500">{{ $envs->name }}</span>
                  </div>
               @endforeach
            </div>
            {{-- 選択したバトルデータの勝敗 --}}
            <div class="mb-5  flex items-center">
               <h2 class="sub_heading">勝敗</h2>・・・
               <div class="font-semibold border-b border-gray-500">
                  @if ($select_battle->judgment === 1)
                     <p class="text-red-600">勝ち</p>
                  @endif
                  @if ($select_battle->judgment === 0)
                     <p class="text-blue-700">負け</p>
                  @endif
                  @if ($select_battle->judgment === 2)
                     <p class="text-red-600">運勝ち</p>
                  @endif
                  @if ($select_battle->judgment === 3)
                     <p class="text-blue-700">運負け</p>
                  @endif
               </div>
            </div>
            {{-- 選択したバトルデータののコメントを表示 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-1">コメント</h2>
               <textarea class="w-full rounded" rows="7" disabled>{{ $select_battle->comment }}</textarea>
            </div>
            {{-- 戻るボタン --}}
            <div class="mb-2 flex justify-end">
               <button onclick="location.href='{{ route('index') }}'" class="btn bg-gray-800 hover:bg-gray-700">
                  戻る
               </button>
            </div>
         </div>
      </div>
   </section>
</x-app-layout>
