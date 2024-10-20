@props([
    'active' => false,
    'to' => '#',
    'name',
])

<li class="nav-item">
    <a href="{{ $to }}" class="nav-link {{ $active ? 'active' : '' }}">
        {{ $slot }}
        <p>
            {{ $name }}
        </p>
    </a>
</li>
