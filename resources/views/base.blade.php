<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <header class="header">
        <div class="container header_container">
            <a href="/" class="header_logo" style="width: 150px">
                <img src="/assets/logo.png" alt="">
            </a>
            <div class="header_right">
                <a href="@auth() {{ route('cart.index') }} @endauth @guest {{ route('sign-up') }} @endguest" class="header_item">
                    <div class="header_title">
                        <img src="/assets/icons/user.svg" alt="">
                        <div class="user_cart_count">{{ auth()->user()?->activeCart?->products?->count() ?? 0 }}</div>
                    </div>
                    <div class="header_item-body">
                        <div class="header_item-title">
                            {{ auth()?->user()->name ?? 'Вы' }}
                        </div>
                        <div class="header_item-text">Аккаунт</div>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
