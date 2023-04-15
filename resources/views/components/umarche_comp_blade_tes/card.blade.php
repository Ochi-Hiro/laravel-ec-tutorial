@props([
    'title',
    'message' => 'messageの初期値',
    'content' => 'contentの初期値'
])

<div {{ $attributes->merge([
        'class' => 'border-2 shadow-2 w-1/4 p-2'
    ]) }} >
    <div>属性で渡すパターン</div>
    <div>{{ $title }}</div>
    <div>画像</div>
    <div>{{ $content }}</div>
    <div>{{ $message }}</div>
</div>