@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="container">
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
    </div>
    <!-- ページネーションリンク -->
    {{ $items->links() }}
@endsection
