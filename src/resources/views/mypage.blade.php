@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="mypage-container">
        <!-- マイページ表示部分 -->
        @if (request()->routeIs('mypage'))
            <!-- ユーザー情報エリア -->

            <div class="user-info">
                <!-- プロフィール画像 -->
                <div class="user_icon">
                    @if ($profile && $profile->img_url)
                        <img src="{{ asset('storage/' . $profile->img_url) }}" alt=""
                            style="width: 100px; height: 100px;">
                    @else
                        <img src="{{ asset('image/default-user.png') }}" alt="デフォルト画像" style="width: 100px; height: 100px;">
                    @endif
                </div>

                <!-- ユーザー名とプロフィール編集ボタン -->
                <div class="user-profiles">
                    @if ($profile)
                        <h2>{{ $profile->name }}</h2>
                    @else
                        <h2>ユーザー名が未設定です</h2>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="profile-edit_button">プロフィールを編集</a>
                </div>
            </div>
        @endif

        <!-- タブ表示 -->
        <div class="tabs">
            <ul class="tab-links">
                <li class="{{ request()->get('tab', 'sold') == 'sold' ? 'active' : '' }}">
                    <a href="{{ route('mypage', ['tab' => 'sold']) }}">出品した商品</a>
                </li>
                <li class="{{ request()->get('tab') == 'purchased' ? 'active' : '' }}">
                    <a href="{{ route('mypage', ['tab' => 'purchased']) }}">購入した商品</a>
                </li>
            </ul>
        </div>
        <!-- タブとアイテムの境界線 -->
        <div class="tab-line"></div>
        <div class="item">
            @if (request()->get('tab', 'sold') == 'sold' && isset($soldProducts))
                @foreach ($soldProducts as $item)
                    <div class="thumbnail">
                        <a href="{{ route('item.show', ['id' => $item->id]) }}">
                            <img src="{{ asset('storage/items/' . basename($item->img_url)) }}" alt="">
                        </a>
                        <!-- item_id を表示 -->
                        <p>ID: {{ $item->id }}</p>
                        <!-- その他の商品情報をここに表示 -->
                    </div>
                @endforeach
                <!-- 出品した商品のページネーションリンク -->
                {{ $soldProducts->appends(['tab' => 'sold'])->onEachSide(1)->links() }}
            @elseif(request()->get('tab') == 'purchased' && isset($purchasedProducts))
                @foreach ($purchasedProducts as $item)
                    <div class="thumbnail">
                        <a href="{{ route('item.show', ['id' => $item->item->id]) }}">
                            <img src="{{ asset('storage/items/' . basename($item->item->img_url)) }}" alt="">
                        </a>
                        <!-- item_id を表示 -->
                        <p>ID: {{ $item->id }}</p>
                        <!-- その他の商品情報をここに表示 -->
                    </div>
                @endforeach
                <!-- ページネーションリンク -->
                <!-- 購入した商品のページネーションリンク -->
                {{ $purchasedProducts->appends(['tab' => 'purchased'])->onEachSide(1)->links() }}
            @endif
        </div>

    </div>
    <!-- プロフィール編集フォームの表示部分 -->
    @if (request()->routeIs('profile.edit'))
        <div id="profile_edit-form">
            <h3>プロフィール編集</h3>
            <!-- エラーメッセージ表示部分 -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style-type: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-form_group">
                    <label for="img_url">プロフィール画像</label>
                    <input type="file" id="img_url" name="img_url" accept="image/*">
                </div>
                <div class="profile-form_group">
                    <label for="name">名前</label>
                    <input type="text" id="name" name="name" value="{{ $profile->name ?? '' }}" required>
                </div>
                <div class="profile-form_group">
                    <label for="postcode">郵便番号</label>
                    <input type="text" id="postcode" name="postcode" value="{{ $profile->postcode ?? '' }}" required>
                </div>
                <div class="profile-form_group">
                    <label for="address">住所</label>
                    <input type="text" id="address" name="address" value="{{ $profile->address ?? '' }}" required>
                </div>
                <div class="profile-form_group">
                    <label for="building">建物名</label>
                    <input type="text" id="building" name="building" value="{{ $profile->building ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary">保存する</button>
            </form>
        </div>
    @endif
    </div>
@endsection
