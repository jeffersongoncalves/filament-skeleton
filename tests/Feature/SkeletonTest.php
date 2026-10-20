<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;

it('injects the skeleton styles and script into the panel head', function () {
    $this->get('/admin/login')
        ->assertOk()
        ->assertSee('--fi-skeleton-bg', false)
        ->assertSee("Livewire.hook('commit'", false)
        ->assertSee('data-animate="pulse" data-delay="150"', false);
});

it('adds the CSP nonce when one is set', function () {
    Vite::useCspNonce('test-nonce');

    $this->get('/admin/login')
        ->assertOk()
        ->assertSee('<style nonce="test-nonce">:root {', false)
        ->assertSee('<script nonce="test-nonce" data-animate="pulse"', false);
});

it('renders the skeleton components with the group animation', function () {
    $html = Blade::render(<<<'BLADE'
        <x-filament-skeleton::skeleton.group animate="shimmer">
            <x-filament-skeleton::skeleton class="size-10" />
            <x-filament-skeleton::skeleton.line size="lg" />
        </x-filament-skeleton::skeleton.group>
        BLADE);

    expect($html)
        ->toContain('data-fi-skeleton-group')
        ->toContain('class="fi-skeleton size-10"')
        ->toContain('class="fi-skeleton-line" data-size="lg"')
        ->and(substr_count($html, 'data-animate="shimmer"'))->toBe(2);
});
