<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Panel Admin ETHERLIST
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-xl p-6 sm:p-8 text-gray-100">
                <h3 class="text-2xl font-semibold mb-4">Selamat datang, Admin ETHERLIST 👋</h3>
                <p class="text-gray-400 mb-6">Gunakan panel ini untuk mengelola pengguna dan data sistem</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <a href="{{ route('admin.users.index') }}"
                       class="block bg-slate-800 hover:bg-slate-700 transition-all duration-300 rounded-xl p-6 shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-indigo-600 text-white rounded-full p-3">
                                <i class="fa-solid fa-users text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium">Manajemen Pengguna</h4>
                                <p class="text-sm text-gray-400">Lihat dan kelola semua user</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
