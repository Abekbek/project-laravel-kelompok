@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition
         class="flex items-center justify-between mb-4 rounded-md bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 px-4 py-3 text-green-700 dark:text-green-300"
         role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
        <button @click="show = false" type="button" class="ms-4">
            <svg class="h-6 w-6 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </button>
    </div>
@endif
