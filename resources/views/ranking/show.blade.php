<x-app-layout>
    
    <x-slot name="head_styles">
        <style>
            html, body {
                overflow: hidden;
            }
            .page-content-wrapper {
                height: 100vh;
                overflow-y: auto;
                padding-bottom: 200px;
            }
        </style>
    </x-slot>

    {{-- Wrapper untuk konten yang bisa di-scroll --}}
    <div class="page-content-wrapper">
        <x-slot name="header">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h2 class="font-semibold text-xl text-gray-200 leading-tight truncate">
                    {{ $template->title }}
                </h2>
                <div class="flex items-center space-x-2 flex-shrink-0">
                    <button id="download-button" class="inline-flex items-center gap-x-2 rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 transition-colors">
                        <i class="fa-solid fa-download fa-sm"></i><span>Download</span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-x-2 rounded-md bg-slate-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-600 transition-colors">
                        <i class="fa-solid fa-arrow-left fa-sm"></i><span>Kembali</span>
                    </a>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="tierlist-capture-area" class="bg-slate-950 p-4">
                    <h2 class="text-3xl font-bold text-white text-center mb-6">{{ $template->title }}</h2>
                    <div id="tier-grid">
                        @foreach($template->tierRows as $row)
                            <div class="flex items-stretch mb-1">
                                {{-- 1. Tambahkan class h-24 agar tinggi & lebar sama (jadi kotak) dan perbesar font --}}
                                <div class="w-32 h-28 flex-shrink-0 flex items-center justify-center font-bold text-black text-2xl" style="background-color: {{ $row->color }}; text-shadow: 0 0 2px rgba(255,255,255,0.7);">
                                    {{ $row->label }}
                                </div>
                                {{-- 2. Sesuaikan min-height di sini menjadi min-h-24 agar pas dengan kotak label & gambar --}}
                                <div class="tier-items sortable-list flex-grow flex flex-wrap items-center gap-2 p-2 bg-slate-800 min-h-24" data-tier-id="{{ $row->id }}"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed bottom-0 z-50 w-full bg-slate-900/80 backdrop-blur-sm border-t border-slate-700 p-4">
        {{-- Kita jadikan div pembungkus ini sebagai item-pool --}}
        <div id="item-pool" class="sortable-list min-h-[100px] max-w-7xl mx-auto flex flex-wrap gap-2 justify-center">
            @foreach($template->items as $item)
                {{-- Loop ini hanya untuk item yang belum di-ranking --}}
                @if(!isset($ranked_items) || !in_array($item->id, $ranked_items))
                    <div class="rank-item" data-item-id="{{ $item->id }}">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Item" class="w-24 h-24 object-cover rounded-md cursor-grab">
                    </div>
                @endif
            @endforeach
       </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const lists = document.querySelectorAll('.sortable-list');
        lists.forEach(list => {
            new Sortable(list, {
                group: 'tierlist',
                animation: 150,
                ghostClass: 'opacity-50',
            });
        });

        document.getElementById('download-button').addEventListener('click', function() {
            const captureArea = document.getElementById('tierlist-capture-area');
            const originalTitle = document.title;
            document.title = 'etherlist-{{ Str::slug($template->title) }}'; // Untuk nama file
            
            html2canvas(captureArea, {
                backgroundColor: '#020617', // Warna slate-950
                useCORS: true, 
                logging: false
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = document.title + '.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                document.title = originalTitle; // Kembalikan judul asli
            });
        });

    });
    </script>
    @endpush
</x-app-layout>