<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cytech EC</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="{{ route('products.index') }}" class="header__logo">Cytech EC</a>
            <nav class="header__nav">
                <a href="{{ route('products.index') }}" class="header__nav-link">Home</a>
                @auth
                    <a href="{{ route('mypage.index') }}" class="header__nav-link">マイページ</a>
                    <span class="header__user">ログインユーザー: {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="header__logout-form">
                        @csrf
                        <button type="submit" class="btn btn--danger">ログアウト</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="header__nav-link">ログイン</a>
                    <a href="{{ route('register') }}" class="header__nav-link">新規登録</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="main">
        @if (session('success'))
            <div class="alert alert--success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert--error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__inner">
            <a href="{{ route('contact.index') }}" class="btn btn--primary">お問い合わせ</a>
            <nav class="footer__nav">
                <a href="{{ route('products.index') }}" class="footer__nav-link">Home</a>
                @auth
                    <a href="{{ route('mypage.index') }}" class="footer__nav-link">マイページ</a>
                @endauth
            </nav>
            <p class="footer__copy">&copy; 2024 Company, Inc</p>
        </div>
    </footer>
</body>
</html>
