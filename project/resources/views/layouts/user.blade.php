<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/base.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="header_logo">My Cheat Sheet</h1>
        <div class="header_contents">
            <div class="user_info">
                <span class="material-icons">
                person
                </span>
                <p class="user_id">
                    {{ $user_id }}
                </p>
            </div>
            <span class="header_decoration">|</span>
            <a class="logout" href="{{ route('logout') }}">ログアウト</a>
        </div>
    </header>

    <div class="main-contents">
        <div class="left-side-contents">
            <p class="all"><a href="{{ route('show_top') }}">全て</a></p>

            <div class="favorite">
                <p>お気に入り</p>
                <ul>
                    @if (@$themes)
                        @foreach ($themes as $theme)
                            @if ($theme['favorite'] == 1)
                                <li><a href="{{ route('show_theme', $theme['id']) }}">{{ $theme['name'] }}</a></li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <div class="right-side-contents">
            @yield('content')
        </div>
    </div>
</body>
</html>
