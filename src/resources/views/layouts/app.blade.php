<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-ma</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
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
            <a href="/sell" class="sell-button">出品</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>