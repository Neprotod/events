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
        <link href="{{ URL::asset('assets/admin/css/css.css') }}" rel="stylesheet">

        <!-- js -->
        <script src="{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ URL::asset('js/js.js') }}"></script>
    </head>
    <body class="{{ $prefix_body }}">
        <div class="container-fluid">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if(Auth::guard('admin')->check())
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="Logout" class="btn btn-outline-secondary">Выйти</button>
                        </form>
                    @endif
                </div>
            @endif
            <div class="row">
                <div class="col-2 left_menu">
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="{{ route("admin.home") }}">Главная</a>
                    </nav>
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="{{ route("admin.users") }}">Пользователи</a>
                    </nav>
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="{{ route("admin.comment") }}">Посты</a>
                    </nav>
                </div>
                <div class="col">
                    <div id="wrap" class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
