@props([
    'to' => '#',
])

<li class="mb-4">
    <a href="{{ $to }}" class="hover:underline">{{ $slot }}</a>
</li>
