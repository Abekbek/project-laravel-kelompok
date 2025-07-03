<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Hasil Pencarian untuk: <span class="text-indigo-400">'{{ $query }}'</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($results->isEmpty())
                <p class="text-center text-gray-400 text-lg">Tidak ada template yang ditemukan dengan kata kunci tersebut.</p>
            @else
                {{-- Kita gunakan desain grid yang sama seperti di dashboard --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($results as $template)
                        <div class="group relative aspect-square">
                            <a href="{{ route('ranking.show', $template) }}">
                                <img src="{{ $template->cover_image_path ? asset('storage/' . $template->cover_image_path) : 'https://via.placeholder.com/300/1e293b/FFFFFF?text=ETHERLIST' }}"
                                     alt="{{ $template->title }}"
                                     class="w-full h-full object-cover rounded-lg group-hover:opacity-75 transition-opacity">
                            </a>
                            <div class="absolute inset-0 bg-black/20 rounded-lg"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-3 text-white">
                                <h4 class="font-bold truncate">{{ $template->title }}</h4>
                                <p class="text-xs text-gray-300 truncate">oleh {{ $template->user->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Link untuk Paginasi jika hasil lebih dari satu halaman --}}
                <div class="mt-8">
                    {{ $results->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>