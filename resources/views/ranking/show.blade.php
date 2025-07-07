<x-app-layout>
    <x-slot name="head_styles">
        <style>
            .item.draggable, .sortable-fallback {
                position: relative;
                background-size: cover;
                background-position: center;
                border: 1px solid #4A5568;
            }

            .sortable-ghost {
                opacity: 0.4;
                background: #4f46e5;
            }

            .tier-label {
                font-size: 1rem;
                text-align: center;
                padding: 0.5rem;
                word-break: break-word;
                overflow-wrap: break-word;
                line-height: 1.2;
            }

            #scroll-left, #scroll-right {
                backdrop-filter: blur(4px);
            }

            @media (max-width: 640px) {
                .tier-row {
                    min-height: 64px !important;
                }

                .tier-label {
                    font-size: 0.75rem !important;
                    width: 64px !important;
                }

                .tier-dropzone .item {
                    width: 64px !important;
                    height: 64px !important;
                }
            }

        </style>
    </x-slot>

    <div id="capture-area" class="bg-slate-950 pt-8 pb-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-bebas text-5xl text-center text-white tracking-wider mb-6">
                {{ $template->title }}
            </h2>
            <div id="tier-container" class="space-y-px">
                @foreach($template->tierRows as $row)
                <div class="tier-row flex items-stretch min-h-[96px] bg-slate-800 shadow-lg">
                    <div class="tier-label text-black font-bebas text-3xl w-24 flex-shrink-0 flex items-center justify-center" style="background-color: {{ $row->color }};">
                        {{ $row->label }}
                    </div>
                    <div class="tier-dropzone sortable-list flex-grow p-1 flex flex-wrap content-start items-start gap-1"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="item-pool-container" class="sticky bottom-0 z-20 w-full bg-slate-900 transition-all duration-300 border-t-2 border-slate-700 pt-4 sm:pt-0">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-4">
            <h3 class="font-semibold text-xl text-white mb-3 px-1">Item Pool</h3>
            <div class="relative">
                <div id="item-pool" class="sortable-list p-1 flex flex-nowrap gap-2 min-h-[96px] overflow-x-auto scroll-smooth">
                    @foreach($template->items as $item)
                    <div class="item draggable w-[88px] h-[88px] bg-cover bg-center cursor-move flex-shrink-0"
                        style="background-image: url('{{ asset('storage/' . $item->image_path) }}')"
                        data-item-id="{{ $item->id }}">
                    </div>
                    @endforeach
                </div>

                <div class="flex justify-center items-center gap-4 mt-4 sm:hidden">
                    <button id="scroll-left" class="bg-slate-800 text-white px-4 py-2 rounded-md shadow-md">
                        &lt;
                    </button>
                    <button id="scroll-right" class="bg-slate-800 text-white px-4 py-2 rounded-md shadow-md">
                        &gt;
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mt-8 flex justify-center items-center gap-4">
            <button id="download-btn" class="px-8 py-3 bg-green-600 text-white font-semibold rounded-full shadow-lg hover:bg-green-500 transition-colors">
                Download as PNG
            </button>
            <button id="reset-btn" class="px-8 py-3 bg-red-600 text-white font-semibold rounded-full shadow-lg hover:bg-red-500 transition-colors">
                Reset Tier List
            </button>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sortableOptions = {
            group: 'tier-list',
            animation: 150,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            forceFallback: true,
            fallbackClass: 'sortable-fallback'
        };

        document.querySelectorAll('.sortable-list').forEach(zone => new Sortable(zone, sortableOptions));

        const downloadBtn = document.getElementById('download-btn');
        downloadBtn.addEventListener('click', function () {
            const captureArea = document.getElementById('capture-area');
            const originalBtnText = downloadBtn.innerHTML;
            downloadBtn.disabled = true;
            downloadBtn.innerHTML = 'Membuat gambar...';

            html2canvas(captureArea, {
                backgroundColor: '#0f172a',
                useCORS: true,
                logging: false,
                scale: 2
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = '{{ Str::slug($template->title) }}-etherlist.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            }).catch(function (error) {
                console.error('Download Error:', error);
                alert('Gagal membuat gambar.');
            }).finally(function () {
                downloadBtn.disabled = false;
                downloadBtn.innerHTML = originalBtnText;
            });
        });

        const resetBtn = document.getElementById('reset-btn');
        resetBtn.addEventListener('click', function () {
            const itemPool = document.getElementById('item-pool');
            document.querySelectorAll('.tier-dropzone .item').forEach(item => {
                itemPool.appendChild(item);
            });
        });

        document.getElementById('scroll-left').addEventListener('click', function () {
            const pool = document.getElementById('item-pool');
            pool.scrollBy({ left: -120, behavior: 'smooth' });
        });

        document.getElementById('scroll-right').addEventListener('click', function () {
            const pool = document.getElementById('item-pool');
            pool.scrollBy({ left: 120, behavior: 'smooth' });
        });
    });
    </script>
    @endpush
</x-app-layout>
