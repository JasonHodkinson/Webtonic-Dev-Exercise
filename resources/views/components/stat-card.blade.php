@props(['number'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="text-center">
            <div class="font-black text-5xl text-indigo-700 pb-4">{{ $number }}</div>
            <hr class="pb-4 mx-10">
            <div class="uppercase tracking-tighter whitespace-nowrap">{{ $slot }}</div>
        </div>
    </div>
</div>