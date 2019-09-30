<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>Лифты</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Лифты</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Отчеты</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('orders') }}" class="dropdown-item">Вызовы лифтов</a>
                            <a href="{{ route('iterations') }}" class="dropdown-item">Итерации</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stats') }}">Статистика</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="mt-5 container">
        @yield('content')
    </section>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
