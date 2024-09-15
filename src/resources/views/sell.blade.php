@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <div class="sell-container">
        <h1>商品の出品</h1>
        <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sell-form_group">
                <label for="img_url">商品画像</label>
                <input type="file" id="img_url" name="img_url" accept="image/*" required>
            </div>
            <h2>商品の詳細</h2>
            <div class="sell-form_group">
                <label for="category_ids">カテゴリー</label>
                <select name="category_ids[]" id="category_ids" multiple required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sell-form_group">
                <label for="condition_id">商品の状態</label>
                <select name="condition_id" id="condition_id" required>
                    <option value="" disabled selected>選択してください</option>
                    @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                </select>
            </div>
            <h2>商品名と説明</h2>
            <div class="sell-form_group">
                <label for="name">商品名</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="sell-form_group">
                <label for="description">商品の説明</label>
                <textarea name="description" id="description" rows="4 required"></textarea>
            </div>
            <h2>販売価格</h2>
            <div class="sell-form_group">
                <label for="price">販売価格</label>
                <input type="number" name="price" id="price" required>円
            </div>
            <button type="submit">出品する</button>
        </form>
    </div>
@endsection
