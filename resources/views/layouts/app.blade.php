<!DOCTYPE html>
<html lang="ru">
<head>
   <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta http-equiv="X-Frame-Options" content="sameorigin">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="robots" content="index, nofolow">
   <meta name="generator" content="">
   <link rel="stylesheet" href="{{ asset('css/style.css?_v=20231026161843') }}">
   <script src="https://kit.fontawesome.com/4cff2d24fe.js?_v=20231026161843" crossorigin="anonymous"></script>
   <meta name="msapplication-TileColor" content="#E74F42" />
   <meta name="msapplication-TileImage" content="{{ asset('img/logo.png') }}" />
   <meta name="theme-color" content="#E74F42" />
   <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
   <title>@yield('title')</title>
</head>
</head>
<body>
    @include('inc.header')

    @yield('container')

    @include('inc.footer')

    @include('inc.scripts')
</body>
</html>