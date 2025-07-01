<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-alert />

            <h3 class="mb-4 text-lg font-medium text-gray-100">Template yang Saya Buat</h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                <a href="{{ route('templates.create') }}"
                   class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-slate-700 bg-slate-900/50 text-slate-400 transition hover:border-slate-600 hover:text-white aspect-square">
                    <i class="fa-solid fa-plus text-4xl"></i>
                    <span class="mt-2 font-semibold">Tambah Tier List</span>
                </a>

                @forelse($myTemplates as $template)
                    <div class="group relative aspect-square">
                        <a href="{{ route('templates.edit', $template) }}">
                            <img src="{{ $template->cover_image_path ? asset('storage/' . $template->cover_image_path) : 'https://via.placeholder.com/300/1e293b/FFFFFF?text=ETHERLIST' }}"
                                 alt="{{ $template->title }}"
                                 class="w-full h-full object-cover rounded-lg group-hover:opacity-75 transition-opacity">
                        </a>
                        <div class="absolute bottom-0 left-0 right-0 h-2/5 bg-gradient-to-t from-black/80 via-black/50 to-transparent rounded-b-lg pointer-events-none"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white pointer-events-none">
                            <h4 class="font-bold truncate">{{ $template->title }}</h4>
                            <p class="text-xs text-gray-300 truncate">Dibuat {{ $template->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="absolute top-2 right-2 flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('templates.edit', $template) }}" class="flex items-center justify-center w-8 h-8 bg-black/50 hover:bg-black/75 rounded-full text-white">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('templates.destroy', $template) }}" onsubmit="return confirm('Anda yakin ingin menghapus template ini? Ini tidak bisa dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full bg-red-600/70 text-white hover:bg-red-600">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
