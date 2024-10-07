@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <div class="sell-container">
        <h1>商品の出品</h1>
        <form action="{{ isset($item) ? route('item.update', ['id' => $item->id]) : route('sell.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- 商品画像 -->
            <div class="sell-form_group">
                <label for="img_url">商品画像</label>
                @if (isset($item) && $item->img_url)
                    <img src="{{ asset('storage/items/' . basename($item->img_url)) }}" alt="商品画像">
                @endif
                <div class="file-input-wrapper">
                    <label for="img_url" class="file-select-button">画像を選択する</label>
                    <input type="file" id="img_url" name="img_url" accept="image/*" style="display: none;"
                        {{ isset($item) ? '' : 'required' }} />
                    <span id="file-name" class="file-name">ファイルが選択されていません</span>
                </div>
            </div>
            <h2>商品の詳細</h2>
            <!-- カテゴリー -->
            <div class="sell-form_group">
                <label for="category_ids">カテゴリー</label>
                <select name="category_ids[]" id="category_ids" multiple required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($item) && in_array($category->id, $item->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- 商品の状態 -->
            <div class="sell-form_group">
                <label for="condition_id">商品の状態</label>
                <select name="condition_id" id="condition_id" required>
                    <option value="" disabled {{ isset($item) ? '' : 'selected' }}>選択してください</option>
                    @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}"
                            {{ isset($item) && $item->condition_id == $condition->id ? 'selected' : '' }}>
                            {{ $condition->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <h2>商品名と説明</h2>
            <!-- 商品名 -->
            <div class="sell-form_group">
                <label for="name">商品名</label>
                <input type="text" name="name" id="name"
                    value="{{ old('name', isset($item) ? $item->name : '') }}" required>
            </div>
            <div class="sell-form_group">
                <!-- 商品の説明 -->
                <label for="description">商品の説明</label>
                <textarea name="description" id="description" rows="4" required>{{ old('description', isset($item) ? $item->description : '') }}</textarea>
            </div>
            <h2>販売価格</h2>
            <!-- 販売価格 -->
            <div class="sell-form_group">
                <label for="price">販売価格</label>
                <div class="price-wrapper">
                    <span class="currency-symbol">￥</span>
                    <input type="number" name="price" id="price"
                        value="{{ old('price', isset($item) ? $item->price : '') }}">
                </div>
            </div>
            <button type="submit" class="sell-form_button">{{ isset($item) ? '更新する' : '出品する' }}</button>
        </form>
    </div>
    <script>
        document.getElementById('img_url').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : "ファイルが選択されていません";
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
@endsection
