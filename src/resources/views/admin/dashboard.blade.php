@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>管理者ダッシュボード</h1>


        <!-- 他の管理機能へのリンクなどをここに追加 -->
        <a href="{{ route('admin.users.index') }}">ユーザー管理</a>
        <a href="{{ route('admin.comments.index') }}">コメント管理</a>

        <form action="{{ route('admin.mail_form', $user->id) }}" method="POST">
            @csrf
            <button type="submit">送信</button>
        </form>
    </div>
@endsection
