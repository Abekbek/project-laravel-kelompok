<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Edit Template: {{ $template->title }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('templates.update', $template) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="title" value="Judul Tier List" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $template->title)" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" value="Deskripsi (Opsional)" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-700 bg-gray-900 text-gray-300 rounded-md shadow-sm">{{ old('description', $template->description) }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>Simpan Perubahan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
