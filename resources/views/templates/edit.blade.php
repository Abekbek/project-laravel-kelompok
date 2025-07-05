<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Edit Template: {{ $template->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-success-alert />

            <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Informasi Template</h3>
                    <form method="POST" action="{{ route('templates.update', $template) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Judul --}}
                            <div>
                                <x-input-label for="title" value="Judul Tier List" />
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="fa-solid fa-pen-fancy text-gray-400"></i>
                                    </div>
                                    <x-text-input id="title" class="block w-full pl-10" type="text" name="title" :value="old('title', $template->title)" required />
                                </div>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            {{-- Foto Sampul --}}
                            <div>
                                <x-input-label for="cover_image" value="Ganti Foto Sampul (Opsional)" />
                                <input id="cover_image" name="cover_image" type="file" accept="image/*" class="block w-full mt-1 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-gray-300 hover:file:bg-slate-600"/>
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6">
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="4"
                                class="block mt-1 w-full bg-slate-900 text-white border border-slate-700 rounded-md shadow-sm placeholder:text-gray-400">
                                {{ old('description') }}
                            </textarea>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button>
                                <i class="fa-solid fa-save mr-2"></i>
                                Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bagian Manajemen Item (Tidak Berubah) --}}
            <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Manajemen Item</h3>

                    <form method="POST" action="{{ route('items.store', $template) }}" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        <div>
                            <x-input-label for="items" value="Upload Item Baru (Bisa Pilih Banyak)" />
                            <input id="items" name="items[]" type="file" multiple accept="image/*" class="block w-full mt-1 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-gray-300 hover:file:bg-slate-600">
                            <x-input-error :messages="$errors->get('items.*')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>Upload</x-primary-button>
                        </div>
                    </form>

                    <h4 class="text-md font-medium mb-2">Item Saat Ini</h4>
                    @if($template->items->isNotEmpty())
                        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-4">
                            @foreach($template->items as $item)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="Tier Item" class="rounded-md w-full h-24 object-cover">
                                    <form method="POST" action="{{ route('items.destroy', $item) }}" onsubmit="return confirm('Yakin hapus item ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="absolute top-1 right-1 flex h-6 w-6 items-center justify-center rounded-full bg-red-600 text-white opacity-0 transition-opacity group-hover:opacity-100">&times;</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada item yang di-upload.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
