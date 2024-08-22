@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <h2>ログイン</h2>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <p>メールアドレス</p>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <p>パスワード</p>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
        </div>
        <button type="submit" class="btn-login">ログインする</button>
    </form>
    <a href="{{ route('register') }}">会員登録はこちら</a>
</div>
@endsection