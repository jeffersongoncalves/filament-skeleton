@aware(['animate' => null])

@props([
    'size' => 'base',
    'animate' => null,
])

<div {{ $attributes->class('fi-skeleton-line') }} data-size="{{ $size }}" @if ($animate) data-animate="{{ $animate }}" @endif data-fi-skeleton-line>
    <div>{{ $slot }}</div>
</div>
