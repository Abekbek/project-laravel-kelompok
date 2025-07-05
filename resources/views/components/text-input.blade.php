@props(['disabled' => false])

<input {{ $attributes->merge([
    'class' => 'bg-slate-900 text-white border border-slate-700 placeholder:text-gray-400 rounded-md shadow-sm transition duration-150 ease-in-out'
]) }} />
