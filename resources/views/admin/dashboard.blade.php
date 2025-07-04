<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-100">
                Selamat datang di Panel Admin ETHERLIST!
                <div class="mt-4">
                    <a href="{{ route('admin.users.index') }}" class="text-indigo-400 hover:underline">
                        Buka Manajemen Pengguna
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
