@extends('layouts.app')

@section('content')
    <div class="comment-container">
        <h1>コメント管理</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>コメント</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection