<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ панель</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand btn btn-primary text-white" href="{{ url('/') }}">
                Перейти на сайт
            </a>
            <a class="navbar-brand">
              Админ панель
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">

                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Войти </a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
                    @else
                        <li><a class="nav-link" href="{{ route('users.index') }}">Пользователи</a></li>
                        <li><a class="nav-link" href="{{ route('roles.index') }}">Роли</a></li>
                        <li><a class="nav-link" href="{{ route('lectures.index') }}">Лекции</a></li>
                        <li><a class="nav-link" href="{{ route('blogs.index') }}">Блог</a></li>
                        <li><a class="nav-link" href="{{ route('tests.index') }}">Тест</a></li>
                        <li><p class="nav-link"> <strong>Пользователь:   {{ Auth::user()->name }}</strong></p></li>
                        <li><a class="nav-link btn btn-primary text-white" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                Выйти
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 bg-light">
        <div class="container">
            @yield('content')
            @yield('scripts')
        </div>
    </main>
</div>
</body>
</html>
