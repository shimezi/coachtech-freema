@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
    <div class="container">
        <!-- アイテム購入ページの条件チェック -->
        @if (request()->is('purchase*') && !request()->is('purchase/address*'))
            <!-- 商品情報 -->
            <div class="item-info">
                <img src="{{ $item->img_url }}" alt="{{ $item->name }}" class="item-thubnail">
                <h2>{{ $item->name }}</h2>
                <p>¥{{ number_format($item->price) }}</p>
            </div>

            <!-- 支払い方法と配送先の変更リンク -->
            {{-- 
            <p>支払い方法</p>
            <a href="{{ route('purchase.payment', ['id' => $item->id]) }}">変更する</a>
            <br>
            <p>配送先</p>
            <a href="{{ route('purchase.address', ['id' => $item->id]) }}">変更する</a>
            --}}
            <!-- 購入ボタン -->
            <form action="{{ route('purchase.store', ['id' => $item->id]) }}" method="POST">
            @csrf
            <button type="submit">購入する</button>
            </form>
        @endif
        <!-- 配送先変更フォーム -->
            @if (request()->routeIs('purchase.address'))
    <h1>住所の変更</h1>
                <form action="{{ route('purchase.address.different', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <div class="address-form_group">
                        <label for="postcode">郵便番号</label>
                        <input type="text" name="postcode" id="postcode" required>
                    </div>
                    <div class="address-form_group">
                        <label for="address">住所</label>
                        <input type="text" name="address" id="address" required>
                    </div>
                    <div class="address-form_group">
                        <label for="building">建物名</label>
                        <input type="text" name="building" id="building">
                    </div>
                    <button type="submit">更新する</button>
                </form>
    @endif
    </div>
@endsection
