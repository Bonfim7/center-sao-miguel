<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Central São Miguel')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/brasao-paroquia-sao-miguel.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/theme/app.css?v={{ filemtime(public_path('assets/css/app.css')) }}">
</head>
<body class="@yield('body-class')">
    @yield('content')
    <script src="/theme/app.js?v={{ filemtime(public_path('assets/js/app.js')) }}" defer></script>
</body>
</html>
