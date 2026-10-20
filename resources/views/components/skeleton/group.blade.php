@props([
    'animate' => null,
])

<div {{ $attributes }} data-fi-skeleton-group>
    {{ $slot }}
</div>
