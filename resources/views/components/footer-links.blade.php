@props(['title'])

<div>
    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">{{ $title }}</h2>
    <ul class="text-gray-500 font-medium">
        {{ $slot }}
    </ul>
</div>
