@extends('layouts.app')

@section('content')
    <div class="login-container">
        <h1>ログイン</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="login-form" action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="login-form_group">
                <label for="emai">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div class="login-form_group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}" required>
            </div>
            <button type="submit" class="login-button">ログイン</button>
        </form>
    </div>
@endsection
