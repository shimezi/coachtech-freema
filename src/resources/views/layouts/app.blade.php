<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-ma</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <script src="https://kit.fontawesome.com/f07aae9695.js" crossorigin="anonymous"></script>
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header-content">

            <a href="/" class="logo">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo">
            </a>

            <form class="search-form">
                <input type="text" placeholder="何なにをお探しですか？">
            </form>

            <a href="{{ route('sell.create') }}" class="sell-button">出品</a>

            @auth
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">ログアウト</button>
                </form>
                <a href="{{ route('mypage') }}" class="mypage-button">マイページ</a>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="login-button">ログイン</a>
                <a href="{{ route('register') }}" class="register-button">会員登録</a>
            @endguest
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @yield('content')
    </main>
</body>

</html>
