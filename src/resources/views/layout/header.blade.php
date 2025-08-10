<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>attendance</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
    @yield('css')
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header_contents">
                <a class="header_logo">
                    <img src="{{asset("img/logo.svg")}}" alt="" class="header-logo">
                </a>
                @if (Auth::check())
                <nav class="responsive_btn">
                    <div class="menu_line"></div>
                    <div class="menu_line"></div>
                    <div class="menu_line"></div>
                </nav>
                <nav class="header_nav">
                    <ul class="header_nav_lists">
                        <li class="nav_link"><a href="">勤怠一覧</a></li>
                        <li class="nav_link"><a href="">スタッフ一覧</a></li>
                        <li class="nav_link"><a href="">申請一覧</a></li>
                        <li class="nav_link">
                            <form action="/logout" method="post">
                            @csrf
                                <button>ログアウト</button>
                            </form>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </header>
        <div class="header_dummy"></div>
        <main class="main">
        @yield('content')
        </main>
    </div>
    <script src="{{asset("js/header.js")}}"></script>
</body>
</html>