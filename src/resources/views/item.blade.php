@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <div class="item-container">
        <div class="item-image">
            <img src="{{ asset($item->img_url) }}" alt="{{ $item->name }}">
        </div>
        <div class="item-info">
            <h1>商品名</h1>
            <p>{{ $item->name }}</p>
            <h2>￥{{ number_format($item->price) }}（値段）</h2>
            <div class="like-section">
                <form action="{{ route('item.like', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    @if (auth()->check() && $item->likes->contains('user_id', auth()->user()->id))
                        <button type="submit" class="like-button"><i class="fa-solid fa-star"></i></button>
                    @else
                        <button type="submit" class="like-button"><i class="fa-regular fa-star"></i></button>
                    @endif
                </form>
                <p class="like-count">{{ $item->likes_count }}</p>
            </div>
            <div class="comment-section">
                <!-- コメントボタンとコメント数 -->
                <div class="comment-buttn_container">
                    <form action="{{ route('comments.showForm', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="comment-button">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                    </form>
                    <p class="comment-count">{{ $item->comments_count }}</p>
                </div>
                <!-- コメントの履歴 -->
                <div class="comment-history">
                    @foreach ($item->comments as $comment)
                        <div class="comment">
                            <p><strong>{{ $comment->user->name }}</strong>さんのコメント</p>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
                <!-- コメントフォーム -->
                @auth
                    @if (session('show_comment-form'))
                        <form action="{{ route('comments.store', $item->id) }}" method="POST">
                            @csrf
                            <p>商品へのコメント</p>
                            <textarea name="comment" rows="4"></textarea>
                            <button type="submit" class="submit_comment-button">コメントを送信する</button>
                        </form>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="comment-button">
                        <i class="fa-regular fa-comment"></i>
                    </a>
                @endauth
            </div>
            <h2>商品説明</h2>
            <p>{!! $item->description !!}</p>
            <h2>商品の情報</h2>
            <p>カテゴリー
                @foreach ($item->categories as $category)
                    {{ $category->name }}
                @endforeach
            </p>
            <p>商品の状態 {{ $item->condition->condition }}</p>
        </div>
    </div>
@endsection
