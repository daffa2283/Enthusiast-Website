<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EnthusiastVerse - Clothing Brand')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Di bagian bawah file, sebelum penutup tag body -->
    @stack('scripts')
    </body>
    </html>