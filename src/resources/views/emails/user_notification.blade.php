@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ユーザーにメールを送信</h1>
    <form action="{{ route('admin.send_email')}}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}">
        <div class="mail-form_group">
            <label for="message">メッセージ</label>
            <textarea name="message" id="message" required></textarea>
        </div>
        <button type="submit" class="send-mail_button">送信</button>
    </form>
</div>
@endsection