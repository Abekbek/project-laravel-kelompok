<footer class="bg-slate-900 text-gray-300 py-10 border-t border-slate-800 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Kolom 1: Brand --}}
        <div>
            <div class="flex items-center mb-4">
                <img src="{{ asset('images/etherlist.png') }}" alt="ETHERLIST Logo" class="h-10 w-10 mr-2">
                <span class="text-2xl font-bold text-white">ETHERLIST</span>
            </div>
            <p class="text-sm text-gray-400">
                Buat dan bagikan tier list favoritmu di ETHERLIST
            </p>
        </div>

        {{-- Kolom 2: Navigasi --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Navigasi</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('welcome') }}" class="hover:text-white transition">Beranda</a></li>
                <li><a href="{{ route('templates.create') }}" class="hover:text-white transition">Buat Tier List</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white transition">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-white transition">Register</a></li>
            </ul>
        </div>

        {{-- Kolom 3: Kontak & Sosial --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Hubungi Kami</h3>
            <p class="text-sm text-gray-400">oihukuji@gmail.com</p>
            <div class="flex space-x-4 mt-4 text-gray-400">
                <a href="https://www.instagram.com/etherlist?igsh=MXhmNDh5YWc5dDY5dQ==" class="hover:text-white transition" target="_blank">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="https://wa.me/6285721828443?text=Hello!" class="hover:text-white transition" target="_blank">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>
                <a href="https://discord.gg/bS2ke6u7" class="hover:text-white transition" target="_blank">
                    <i class="fab fa-discord text-xl"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="mt-10 text-center text-xs text-gray-500">
        &copy; {{ now()->year }} ETHERLIST. All rights reserved.
    </div>
</footer>
