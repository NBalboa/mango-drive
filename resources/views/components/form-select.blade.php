@props(['id', 'name'])


<select class="custom-select rounded-0" id="{{ $id }}" name="{{ $name }}">
    {{ $slot }}
</select>
