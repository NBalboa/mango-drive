@props([
    'to' => '#',
])
<a href="{{ $to }}"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600">
    {{ $slot }}
</a>
