@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h2>会員登録</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <p>メールアドレス</p>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <p>パスワード</p>
            <input type="password" name="password" id="password" value="{{ old('password') }}" required>
        </div>
        <button type="submit" class="btn-register">登録する</button>
    </form>
    <a href="{{ route('login') }}" class="login-link">ログインはこちらから</a>
</div>
@endsection