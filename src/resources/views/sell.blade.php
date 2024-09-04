@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <div class="sell-container">
        <h1>商品の出品</h1>
        <form action="{{ route('/sell') }}" method="POST">
            @csrf
            <div class="sell-form_group">
                <label for="img_url">商品画像</label>
                <input type="file" id="img_url" name="img_url" accept="image/*">
            </div>
            <h2>商品の詳細</h2>
            <div class="sell-form_group">
                <label for="category">カテゴリー</label>
                <input type="text" name="category" id="category">
            </div>
        </form>
    </div>
@endsection
