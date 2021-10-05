@props(['invalid' => false, 'disabled' => false])

@php
$classes = ($invalid)
        ? 'border-red-600 focus:ring-red-600 block w-full overflow-hidden cursor-pointer border text-gray-800 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:border-transparent'
        : 'border-gray-300 focus:ring-blue-600 block w-full overflow-hidden cursor-pointer border text-gray-800 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:border-transparent';
@endphp

<input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!} />
