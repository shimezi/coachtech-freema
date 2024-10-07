@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <!-- アイテム詳細表示のためのページ分岐 -->
    @if (request()->routeIs('item.show'))
        <div class="item-container">
            <div class="item-image">
                <img src="{{ asset('storage/items/' . basename($item->img_url)) }}" alt="">
            </div>

            <div class="item-info">
                <h1>{{ $item->name }}</h1>
                <h2>￥{{ number_format($item->price) }}（値段）</h2>

                <!-- いいね機能 -->
                <div class="like-section">
                    <form action="{{ route('item.like', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @if (auth()->check() && $item->likes->contains('user_id', auth()->user()->id))
                            <button type="submit" class="like"><i class="fa-solid fa-star"></i></button>
                        @else
                            <button type="submit" class="like"><i class="fa-regular fa-star"></i></button>
                        @endif
                    </form>
                    <p class="like-count">{{ $item->likes_count }}</p>
                </div>

                <!-- コメントアイコンとコメント数 -->
                <div class="comment-section">
                    <a href="{{ route('item.comments', ['id' => $item->id]) }}" class="comment-button">
                        <i class="fa-regular fa-comment"></i>
                    </a>
                    <p class="comment-count">{{ $item->comments_count }}</p>
                </div>

                <!-- 購入ボタン -->
                @auth
                    <form action="{{ route('purchase.create', ['id' => $item->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="purchase-button">購入する</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="purchase-button">購入する</a>
                @endauth

                <!-- 商品説明 -->
                <h2>商品説明</h2>
                <p>{!! $item->description !!}</p>

                <!-- 商品の情報 -->
                <h2>商品の情報</h2>
                <p>カテゴリー:
                    @foreach ($item->categories as $category)
                        {{ $category->name }}
                    @endforeach
                </p>
                <p>商品の状態: {{ $item->condition ? $item->condition->name : '状態情報がありません' }}</p>
            </div>
        </div>
    @endif

    <!-- コメントフォーム表示のためのページ分岐 -->
    @if (request()->routeIs('item.comments'))
        <div class="comment-container">
            <h2>商品へのコメント</h2>

            <!-- コメント履歴 -->
            <div class="comment-history">
                @foreach ($item->comments as $comment)
                    <div class="comment">
                        <p><strong>{{ $comment->user ? $comment->user->name : 'ゲストユーザー' }}</strong>さんのコメント</p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @endforeach
            </div>

            <!-- コメントフォーム -->
            <form action="{{ route('comments.store', $item->id) }}" method="POST">
                @csrf
                <textarea name="comment" rows="4" required></textarea>
                <button type="submit" class="submit_comment-button">コメントを送信する</button>
            </form>
        </div>
    @endif
@endsection
