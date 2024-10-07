@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="index-container">
        <div class="tabs">
            <ul class="tab-links">
                <li class="{{ request()->routeIs('index') ? 'active tab-left' : 'tab-left' }}">
                    <a href="{{ route('index') }}">おすすめ</a>
                </li>
                <li class="{{ request()->routeIs('liked.items') ? 'active tab-right' : 'tab-right' }}">
                    <a href="{{ route('liked.items') }}">マイリスト</a>
                </li>
            </ul>
        </div>
        <!-- タブとアイテムの境界線 -->
        <div class="tab-line"></div>
        <div class="item">
            @foreach ($items as $item)
                <div class="thumbnail">
                    <a href="{{ route('item.show', ['id' => $item->id]) }}">
                        <img src="{{ asset('storage/items/' . basename($item->img_url)) }}" alt="">
                    </a>
                    <!-- item_id を表示 -->
                    <p>ID: {{ $item->id }}</p>
                </div>
            @endforeach
        </div>
        <!-- ページネーションリンク -->
        {{ $items->links() }}
    </div>
@endsection
