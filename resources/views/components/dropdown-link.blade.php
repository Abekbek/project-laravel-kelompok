@props(['href'])

<a {{ $attributes->merge([
    'href' => $href,
    'class' => 'block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700 hover:text-gray-100 transition'
]) }}>
    {{ $slot }}
</a>
