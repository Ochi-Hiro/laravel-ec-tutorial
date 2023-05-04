<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <form method="post" action="{{ route('owner.products.store') }}">
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <select name="category">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                            @foreach ($category->secondary as $secondary)
                                                <option value="{{ $secondary->id }}">
                                                    {{ $secondary->name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <x-select-image :images="$images" name="image1" />
                            <x-select-image :images="$images" name="image2" />
                            <x-select-image :images="$images" name="image3" />
                            <x-select-image :images="$images" name="image4" />
                            <div data-micromodal-trigger=""></div>
                            {{-- 4枚の画像を選択できるようにするためcomponentで分ける。controllerからきた$imagesの変数をcomponentに渡す --}}
                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('owner.products.index') }}'"  class="bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button> <!-- シンプルなボタン -->
                                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        'use strict'
        const images = document.querySelectorAll('.image') //imageタグのついている要素を全て取得

        images.forEach( image => { //1つずつ繰り返し
            image.addEventListener('click', function(e){ //クリックした際の動作を設定
                const imageName = e.target.dataset.id.substr(0,6) //data-idの6文字(image1,image2...)の部分を取得
                const imageId = e.target.dataset.id.replace(imageName + '_', '') //上で取得した6文字をカットしてid部分だけにする
                const imageFile = e.target.dataset.file
                const imagePath = e.target.dataset.path
                const modal = e.target.dataset.modal

                //サムネイルとinput type=hiddenのvalueに設定
                document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
                document.getElementById(imageName + '_hidden').value = imageId
                MicroModal.close(modal); //modal閉じる
            })
        });
    </script>

</x-app-layout>
