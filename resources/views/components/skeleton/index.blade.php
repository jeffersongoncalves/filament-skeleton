@aware(['animate' => null])

@props([
    'animate' => null,
])

<div {{ $attributes->class('fi-skeleton') }} @if ($animate) data-animate="{{ $animate }}" @endif data-fi-skeleton-item>
    {{ $slot }}
</div>
