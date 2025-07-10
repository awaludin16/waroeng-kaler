<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white text-gray-900 dark:bg-gray-900 dark:text-white">

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
    const toggleDarkModeBtn = document.getElementById("toggleDarkMode");
    const themeIcon = document.getElementById("themeIcon");

    // Fungsi untuk mengubah mode
    function toggleDarkMode() {
        const html = document.documentElement;
        html.classList.toggle("dark");
        if (html.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
            themeIcon.classList.remove("ri-moon-line");
            themeIcon.classList.add("ri-sun-line");
        } else {
            localStorage.setItem("theme", "light");
            themeIcon.classList.remove("ri-sun-line");
            themeIcon.classList.add("ri-moon-line");
        }
    }

    // Jalankan saat halaman dimuat
    (function () {
        const html = document.documentElement;
        const savedTheme = localStorage.getItem("theme");

        if (savedTheme === "dark" || (!savedTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
            html.classList.add("dark");
            themeIcon.classList.remove("ri-moon-line");
            themeIcon.classList.add("ri-sun-line");
        } else {
            html.classList.remove("dark");
            themeIcon.classList.remove("ri-sun-line");
            themeIcon.classList.add("ri-moon-line");
        }
    })();

    toggleDarkModeBtn.addEventListener("click", toggleDarkMode);
</script>


    </body>
</html>
