<x-app-layout>
   <section class="max-w-screen-lg mx-auto text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
      <h1 class="heading heading_bg">バトルデータの編集</h1>
      {{-- バトルデータを編集するエリア --}}
      <div class="p-3">
         <form action="{{ route('update') }}" method="post">
            @csrf
            @method('patch')
            {{-- 相手の順位を入力 --}}
            <div class="mb-5 flex items-center">
               <h2 class="sub_heading">相手の順位</h2>・・・
               <input class="w-28 h-8 rounded" type="text" name="rank" value="{{ $select_battle->rank }}"
                  placeholder="順位を入力" />
               <p class="ml-2 font-semibold">位</p>
            </div>
            {{-- 相手のチームを選択 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-1">相手のチーム</h2>
               @for ($i = 1; $i <= 6; $i++)
                  <select class="w-40" name="opponent_teams[{{ $i }}]">
                     <option value="">ポケモン選択</option>
                     @foreach ($all_pokemon as $pokemon)
                        <option value="{{ $pokemon->id }}" {{ $opp_teams[$i - 1] == $pokemon->id ? 'selected' : '' }}>
                           {{ $pokemon->name }}
                        </option>
                     @endforeach
                  </select>
               @endfor
            </div>
            {{-- 相手の選出を選択 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-1">相手の選出</h2>
               @for ($i = 1; $i <= 3; $i++)
                  <select class="w-40" name="opponent_selections[{{ $i }}]">
                     <option value="">ポケモン選択</option>
                     @foreach ($all_pokemon as $pokemon)
                        <option value="{{ $pokemon->id }}"
                           {{ $opp_selections[$i - 1] == $pokemon->id ? 'selected' : '' }}>
                           {{ $pokemon->name }}
                        </option>
                     @endforeach
                  </select>
               @endfor
            </div>
            {{-- 自分の選出を選択 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-1">自分の選出</h2>
               @for ($i = 1; $i <= 3; $i++)
                  <select class="w-40" name="player_selects[{{ $i }}]">
                     <option value="">ポケモン選択</option>
                     @foreach ($all_pokemon as $pokemon)
                        <option value="{{ $pokemon->id }}"
                           {{ $player_selects[$i - 1] == $pokemon->id ? 'selected' : '' }}>
                           {{ $pokemon->name }}
                        </option>
                     @endforeach
                  </select>
               @endfor
            </div>
            {{-- 環境を選択 --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-1">環境</h2>
               @foreach ($all_environments as $environment)
                  <div class="hover:font-semibold">
                     <input class="mb-1 rounded" type="checkbox" name="environments[]" id="{{ $environment->id }}"
                        value="{{ $environment->id }}"
                        {{ in_array($environment->id, $environments) ? 'checked' : '' }} />
                     <label for="{{ $environment->id }}">{{ $environment->name }}</label>
                  </div>
               @endforeach
            </div>
            {{-- 勝敗 --}}
            <div class="mb-5 font-semibold">
               <h1 class="mb-1 text-lg">勝敗</h1>
               <input type="radio" name="judgment" id="win" value="1"
                  {{ $select_battle->judgment == 1 ? 'checked' : '' }}>
               <label for="win">勝ち</label>
               <input class="ml-5" type="radio" name="judgment" id="lose" value="0"
                  {{ $select_battle->judgment == 0 ? 'checked' : '' }}>
               <label for="lose">負け</label>
               <input class="ml-5" type="radio" name="judgment" id="lucky_win" value="2"
                  {{ $select_battle->judgment == 2 ? 'checked' : '' }}>
               <label for="lucky_win">運勝ち</label>
               <input class="ml-5" type="radio" name="judgment" id="lucky_lose" value="3"
                  {{ $select_battle->judgment == 3 ? 'checked' : '' }}>
               <label for="lucky_lose">運負け</label>
            </div>
            {{-- バトルデータのコメント --}}
            <div class="mb-5">
               <h2 class="sub_heading mb-1">コメント</h2>
               <textarea class="w-full rounded" name="comment" rows="7" placeholder="ここにコメントを入力">{{ $select_battle->comment }}</textarea>
               {{-- エラーメッセージ（メモの内容） --}}
               {{-- <x-input-error class="mt-2" :messages="$errors->get('content')" /> --}}
            </div>
            {{-- 選択されているメモのidを取得 --}}
            <input type="hidden" name="battleId" value="{{ $select_battle->id }}">
            {{-- メモの更新ボタン --}}
            <div class="mb-5">
               <button class="btn bg-blue-800 hover:bg-blue-700" type="submit">更新する</button>
            </div>
         </form>
         {{-- 戻るボタン --}}
         <div class="flex justify-end">
            <button class="btn bg-gray-800 hover:bg-gray-700" onclick="location.href='{{ route('index') }}'">
               戻る
            </button>
         </div>
      </div>
   </section>
</x-app-layout>
