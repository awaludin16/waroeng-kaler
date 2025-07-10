<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-800 dark:bg-gray-900 dark:text-white font-inter">

    <!-- start: Sidebar -->
    @include('layouts.sidebar')
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main
        class="dark:bg-gray-900 dark:text-white w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">

        <!-- start: Navbar -->
        @isset($navbar)
            {{ $navbar }}
        @endisset
        <!-- end: Navbar -->


        <div class="p-6">
            {{ $slot }}
        </div>

    </main>
    <!-- end: Main -->

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('dist/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
