<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Buat Template Tier List Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-100">
                    <form method="POST" action="{{ route('templates.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Baris untuk Judul & Foto Sampul --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Judul --}}
                            <div>
                                <x-input-label for="title" value="Judul Tier List" />
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="fa-solid fa-pen-fancy text-gray-400"></i>
                                    </div>
                                    <x-text-input id="title" class="block w-full pl-10" type="text" name="title" :value="old('title')" required autofocus />
                                </div>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            {{-- Foto Sampul --}}
                            <div>
                                <x-input-label for="cover_image" value="Foto Sampul (Opsional)" />
                                <input id="cover_image" name="cover_image" type="file" accept="image/*" class="block w-full mt-1 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-gray-300 hover:file:bg-slate-600"/>
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6">
                            <x-input-label for="description" value="Deskripsi (Opsional)" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full bg-slate-900 text-white border border-slate-700 rounded-md shadow-sm placeholder:text-gray-400 align-top">{{ old('description') }}</textarea>

                        </div>

                        {{-- Label Tier --}}
                        <div class="mt-6">
                            <x-input-label for="tiers" value="Label Tier (pisahkan dengan koma)" />
                            <div class="relative mt-1">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-layer-group text-gray-400"></i>
                                </div>
                                <x-text-input id="tiers" class="block w-full pl-10" type="text" name="tiers" value="S, A, B, C, D" required />
                            </div>
                            <x-input-error :messages="$errors->get('tiers')" class="mt-2" />
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button>
                                <i class="fa-solid fa-save mr-2"></i>
                                Simpan Template
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
