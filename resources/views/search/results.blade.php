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
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($results as $template)
                        <div class="group relative aspect-square overflow-hidden rounded-lg">
                            <a href="{{ route('ranking.show', $template) }}" class="block w-full h-full relative group">
                                <img
                                    src="{{ $template->cover_image_path ? asset('storage/' . $template->cover_image_path) : 'https://via.placeholder.com/300/1e293b/FFFFFF?text=ETHERLIST' }}"
                                    alt="{{ $template->title }}"
                                    class="w-full h-full object-cover transition duration-300"
                                >

                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>

                                <div class="absolute bottom-0 left-0 p-2 z-10">
                                    <h4 class="text-white text-sm font-semibold" style="text-shadow: 1px 1px 2px black">{{ $template->title }}</h4>
                                    <p class="text-xs text-gray-300" style="text-shadow: 1px 1px 2px black;">By {{ $template->user->name }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>

                <div class="mt-8">
                    {{ $results->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
