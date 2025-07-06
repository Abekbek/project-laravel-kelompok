<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ETHERLIST</title>
    <link rel="icon" type="image/png" href="{{ asset('images/etherlist.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-slate-950">
    <div class="relative min-h-screen">
        {{-- Navigasi --}}
        <div class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4 gap-4">
                    <div class="flex items-center flex-shrink-0">
                        <a href="{{ route('welcome') }}" class="flex items-center">
                            <img src="{{ asset('images/etherlist.png') }}" alt="ETHERLIST Logo" class="h-10 w-10">
                            <span class="ml-3 text-2xl font-semibold text-white hidden md:block">ETHERLIST</span>
                        </a>
                    </div>

                    <div class="flex-grow flex justify-center px-4">
                        <form action="{{ route('search') }}" method="GET" class="w-full max-w-md">
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                                </div>
                                <input type="search" name="q" placeholder="Cari template..." autocomplete="off"
                                    class="block w-full rounded-md border-0 bg-slate-800 py-1.5 pl-10 text-gray-200 ring-1 ring-inset ring-slate-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                        </form>
                    </div>

                    <div class="flex items-center flex-shrink-0">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-400 hover:text-white transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="ms-4 font-semibold text-gray-200 hover:text-white transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-200 hover:text-white transition">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Hero Section Fullscreen --}}
        <div class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">
            <img src="{{ asset('images/bg.webp') }}" alt="Background" class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <div class="absolute top-0 left-0 w-full h-full bg-black/50 z-10"></div>
            <div class="relative z-20 text-center px-4">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                    Buat dan Bagikan <span class="text-indigo-400">Tier List</span> Kerenmu
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-200" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.8);">
                    Dari game, film, anime, manga dan Tier List keren lainnya
                </p>
                <div class="mt-8">
                    @auth
                        <a href="{{ route('templates.create') }}"
                            class="inline-block text-indigo-400 font-bold text-lg hover:underline hover:underline-offset-4 transition duration-200"
                            style="text-shadow: 0 0 1px black, 0 0 2px black;">
                            Mulai Membuat, Gratis!
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="inline-block text-indigo-400 font-bold text-lg hover:underline hover:underline-offset-4 transition duration-200"
                            style="text-shadow: 0 0 1px black, 0 0 2px black;">
                            Mulai Membuat, Gratis!
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Galeri Template Populer --}}
        <div class="bg-slate-950">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-16">
                <h2 class="text-3xl font-bold text-white mb-8">Template Populer</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @forelse($popularTemplates as $template)
                        <div class="group aspect-square overflow-hidden rounded-lg relative">
                            <a href="{{ route('ranking.show', $template) }}" class="block w-full h-full relative">
                                @if ($template->cover_image_path)
                                    <img src="{{ asset('storage/' . $template->cover_image_path) }}"
                                         alt="{{ $template->title }}"
                                         class="w-full h-full object-cover rounded-lg group-hover:opacity-75 transition-opacity">
                                @else
                                    <div class="w-full h-full bg-slate-800 text-white flex items-center justify-center text-center rounded-lg text-lg font-semibold group-hover:opacity-75 transition-opacity">
                                        NO COVER
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 rounded-lg"></div>

                                <div class="absolute bottom-0 left-0 p-2 z-10">
                                    <h4 class="text-white text-sm font-semibold" style="text-shadow: 1px 1px 3px black;">
                                        {{ $template->title }}
                                    </h4>
                                    <p class="text-xs text-gray-200" style="text-shadow: 1px 1px 3px black;">
                                        oleh {{ $template->user->name }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-full">Belum ada template yang bisa ditampilkan.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
