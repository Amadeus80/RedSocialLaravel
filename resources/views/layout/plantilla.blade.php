<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    @vite(['resources/css/app.scss', 'resources/js/app.js', 'resources/css/index.css'])
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    {{-- NAVBAR --}}
    @include('layout.components.nav')
    
    {{-- MENSAJE DE ERROR CUANDO SUBES UNA FOTO NO PERMITIDA --}}
    @error('file')
    <div class="alert container alert-danger mt-3">
        {{$message}}
    </div>
    @enderror
    
    {{--  --}}
    @if (session('postPublicado'))
    <div class="alert container alert-success mt-3">
        {{ session('postPublicado') }}
    </div>
    @endif
    
    {{-- CONTENIDO --}}
    <div class="mt-4">
        @yield("content")
    </div>
</body>
</html>