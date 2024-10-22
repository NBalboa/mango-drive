@props(['target', 'class'])


<button type="button" class="{{ $class }}" data-toggle="modal" data-target="#{{ $target }}">
    {{ $slot }}
</button>
