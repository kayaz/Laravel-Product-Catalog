<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap&subset=latin-ext" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/app.css">

        <!-- jQuery -->
        <script src="/js/jquery.js" charset="utf-8"></script>
        <script src="/js/bootstrap.bundle.min.js" charset="utf-8"></script>
        <script src="/js/app.js" charset="utf-8"></script>

    </head>
    <body>
    @auth
        Witaj: <b>{{ Auth::user()->name }}</b>
        <a title="Wyloguj" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="fe-lock"></span> Wyloguj</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
        <main class="pb-5">
            @yield('content')
        </main>
    </body>
</html>
