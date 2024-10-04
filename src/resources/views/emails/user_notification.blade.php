<!-- resources/views/emails/user_notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ユーザー通知</title>
</head>
<body>
    <h1>こんにちは, {{ $user->email }}さん</h1>
    <p>{{ $mailMessage }}</p> <!-- 変数名を変更 -->
</body>
</html>
