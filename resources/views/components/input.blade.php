@props(['invalid' => false])

@php
$classes = ($invalid)
    ? 'mt-1 focus:ring-red-600 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-red-600 rounded-md'
    : 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md';
@endphp

<input {!! $attributes->merge(['class' => $classes]) !!}>
