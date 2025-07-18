<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'ETHERLIST')</title>
        <link rel="icon" type="image/png" href="{{ asset('images/etherlist.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script>
            if (
                localStorage.getItem("theme") === "dark" ||
                (!localStorage.getItem("theme") && window.matchMedia("(prefers-color-scheme: dark)").matches)
            ) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased dark">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-950">
            <div class="flex flex-col items-center">
                <a href="/">
                    <x-application-logo class="w-20 h-20" />
                </a>
                <p class="mt-3 text-xl font-semibold text-gray-800 dark:text-gray-200">ETHERLIST</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-900 shadow-md overflow-hidden border border-black">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
