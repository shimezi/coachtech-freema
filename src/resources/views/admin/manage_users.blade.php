@extends('layouts.app')

@section('content')
    <div class="user-manage_container">
        <h1>ユーザー一覧</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>メールアドレス</th>
                    <th>管理者フラグ</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? '管理者' : '一般ユーザー' }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">削除</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.mail_form', $user->id) }}" class="send-email_button">送信</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }} <!-- ページネーション -->
    </div>

@endsection