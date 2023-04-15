<x-umarche_comp_blade_tes.app>

    <h1>bladeファイルとcomponentについて</h1>
    <br>
    <x-slot name="header_tes">
        名前付きスロット(header_tes)の文字
    <x-slot>
    
    ブレードファイルの文字    

    <x-umarche_comp_blade_tes.card title="titleに渡された文字 タイトル" content="content属性に渡された文字 本文" :message="$message" />
    <x-umarche_comp_blade_tes.card title="titleに渡された文字 タイトル2" />
    <x-umarche_comp_blade_tes.card title="CSSを変更したい" class="bg-red-300"/>
</x-umarche_comp_blade_tes.app>