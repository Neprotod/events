@php
    if(!isset($title)){
        $title = null;
    }
    if(!isset($prefix_body)){
        $prefix_body = null;
    }
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>


        <!-- Styles -->
        <link href="{{ URL::asset('css/bootstrap-reboot.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">

        <!-- js -->
        <script src="{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ URL::asset('js/js.js') }}"></script>
    </head>
    <body class="{{ $prefix_body }}">
        <div class="flex-center position-ref full-height container-fluid">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <div class="login_block">
                            <a href="{{ route('home') }}">Главная</a>
                            <a href="{{ route('account') }}">Аккаунт</a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="Logout" class="btn btn-outline-secondary">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('home') }}">Главная</a>
                        <a href="{{ route('login') }}">Войти</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Регистрация</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div id="wrap" class="container">
                @yield('content')
            </div>
        </div>
    </body>
</html>
