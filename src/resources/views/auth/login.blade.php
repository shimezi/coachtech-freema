@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="login-container">
        <h2 class="login-title">ログイン</h2>
        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="login-form_group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div class="login-form_group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}" required>
            </div>
            <button type="submit" class="login-form_button">ログインする</button>
        </form>
        <a href="{{ route('register') }}" class="register-link">会員登録はこちら</a>
    </div>
@endsection
