<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Komponen untuk notifikasi sukses --}}
            <x-success-alert />

            <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="mb-4 text-lg font-medium">Template yang Saya Buat</h3>
                    <div class="space-y-3">
                        @forelse($myTemplates as $template)
                            <div class="flex items-center justify-between rounded-lg border p-3 border-gray-700">
                                <div>
                                    <a href="{{ route('templates.edit', $template) }}" class="font-bold text-indigo-400 hover:underline">{{ $template->title }}</a>
                                    <p class="text-sm text-gray-500">Dibuat {{ $template->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('templates.edit', $template) }}" class="text-sm text-gray-400 hover:text-white">Edit</a>

                                    {{-- Form Tombol Hapus dengan Ikon --}}
                                    <form method="POST" action="{{ route('templates.destroy', $template) }}" onsubmit="return confirm('Anda yakin ingin menghapus template ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-400">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Anda belum membuat template. <a href="{{ route('templates.create') }}" class="text-indigo-400 hover:underline">Buat sekarang</a>.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
