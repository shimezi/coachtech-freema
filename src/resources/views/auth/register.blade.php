@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h2 class="register-title">会員登録</h2>
    <form class="register-form" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="register-form_group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div class="register-form_group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}" required>
        </div>
        <button type="submit" class="register-form_button">登録する</button>
    </form>
    <a href="{{ route('login') }}" class="login-link">ログインはこちらから</a>
</div>
@endsection