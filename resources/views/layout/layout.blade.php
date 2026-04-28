<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{public_path('css/style.css')}}">
    <link rel="stylesheet" href="{{public_path('css/about.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @yield('gsap')
    @yield('auth-css')
    @yield('bootstrap-css')
    @vite(['resources/css/app.css', 'resources/css/about.css', 'resources/js/app.js', 'resources/js/about.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
<header>
    @include('layout.sections.header')
</header>
<main class="flex-grow-1">
    <div class="content">
        @yield('content')
    </div>
</main>

@yield('bootstrap-js')
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
</body>
</html>
