<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-ma</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script src="https://kit.fontawesome.com/f07aae9695.js" crossorigin="anonymous"></script>
    @yield('css')
</head>

<body>
    <div class="common-container">
        <header class="header">
            <div class="header-content">

                <a href="/" class="logo">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo">
                </a>

                <form class="search-form">
                    <input type="text" placeholder="なにをお探しですか？">
                </form>

                @auth
                    @if (!request()->routeIs('login') && !request()->routeIs('register'))
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-button">ログアウト</button>
                        </form>
                        <a href="{{ route('mypage') }}" class="mypage-button">マイページ</a>
                    @else
                        <!-- ログインページや登録ページで非表示に -->
                        <form class="logout-form" style="visibility: hidden;">
                            <button class="logout-button">ログアウト</button>
                        </form>
                        <a href="#" class="mypage-button" style="visibility: hidden;">マイページ</a>
                    @endif
                @endauth

                @guest
                    @if (!request()->routeIs('login') && !request()->routeIs('register'))
                        <a href="{{ route('login') }}" class="login-button">ログイン</a>
                        <a href="{{ route('register') }}" class="register-button">会員登録</a>
                    @else
                        <!-- ログインページや登録ページで非表示に -->
                        <a href="#" class="login-button" style="visibility: hidden;">ログイン</a>
                        <a href="#" class="register-button" style="visibility: hidden;">会員登録</a>
                    @endif
                @endguest

                <a href="{{ route('sell.create') }}" class="sell-button">出品</a>

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
    </div>
</body>

</html>
