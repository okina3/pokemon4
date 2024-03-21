<x-app-layout>
   <section class="max-w-screen-lg mx-auto text-gray-600 border border-gray-400 rounded-lg overflow-hidden">
      <div class="px-3 py-2 flex justify-between items-center border-b border-gray-400 bg-gray-200">
         <h1 class="py-1 text-xl font-semibold">環境一覧</h1>
      </div>
      <div class="p-3">
         <x-common.flash-message status="session('status')" />
         {{-- 環境を新規作成エリア --}}
         <form action="{{ route('environment.store') }}" method="post">
            @csrf
            <div class="mb-2 pb-10 border-b border-gray-400">
               <h1 class="mb-1 text-lg font-semibold">環境の新規作成</h1>
                  <input class="form-control rounded w-60" type="text" name="new_environment" placeholder="新規環境を入力" />
                  <button class="ml-2 py-2 px-3 text-white rounded bg-blue-800 hover:bg-blue-700" type="submit">
                     保存
                  </button>
               {{-- 新規タグのエラーメッセージ --}}
               {{-- <x-input-error :messages="$errors->get('new_tag')" class="mt-2" /> --}}
            </div>
         </form>
         {{-- 環境一覧 --}}
         <form onsubmit="return deleteCheck()" action="{{ route('environment.destroy') }}" method="post">
            @csrf
            @method('delete')
            <div class="mb-5">
               <h1 class="mb-1 text-lg font-semibold">既存の環境</h1>
               @foreach ($all_environments as $tag)
                  <div class="border-slate-500 hover:font-semibold">
                     <input class="mb-1 rounded" type="checkbox" name="tags[]" id="{{ $tag->id }}"
                        value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                     <label for="{{ $tag->id }}">{{ $tag->name }}</label>
                  </div>
               @endforeach
            </div>
            <div class="flex justify-end">
               <button class="py-1 px-3 text-white border-0 rounded bg-red-600 hover:bg-red-500" type="submit">
                  環境を削除
               </button>
            </div>
         </form>
         <div class="my-2 flex justify-end">
            <button onclick="location.href='{{ route('index') }}'"
               class="py-1 px-3 text-white rounded bg-gray-800 hover:bg-gray-700">
               戻る
            </button>
         </div>
      </div>
   </section>
</x-app-layout>
