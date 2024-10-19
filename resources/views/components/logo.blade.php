@props([
    'to' => '#',
    'image' => null,
    'alt',
])

<a href="{{ $to }}" class="flex items-center space-x-3 rtl:space-x-reverse">
    @if ($image)
        <img src="{{ $image }}" class="h-8" alt="{{ $alt }}">
    @endif
    <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ $slot }}</span>
</a>
