<?php

namespace JeffersonGoncalves\Filament\Skeleton;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;

class SkeletonPlugin implements Plugin
{
    protected ?string $animate = 'shimmer';

    protected int $delay = 200;

    public function getId(): string
    {
        return 'filament-skeleton';
    }

    public function register(Panel $panel): void
    {
        $panel->renderHook(PanelsRenderHook::HEAD_END, fn (): View => view('filament-skeleton::assets', [
            'animate' => $this->getAnimate(),
            'delay' => $this->getDelay(),
            'css' => file_get_contents(__DIR__.'/../resources/dist/skeleton.css'),
            'js' => file_get_contents(__DIR__.'/../resources/dist/skeleton.js'),
        ]));
    }

    public function boot(Panel $panel): void {}

    /**
     * 'shimmer', 'pulse' or null for a static skeleton.
     */
    public function animate(?string $animate): static
    {
        $this->animate = $animate;

        return $this;
    }

    public function getAnimate(): ?string
    {
        return $this->animate;
    }

    /**
     * Milliseconds a request must run before the skeleton shows, so fast responses don't flash.
     */
    public function delay(int $milliseconds): static
    {
        $this->delay = $milliseconds;

        return $this;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static */
        return filament(app(static::class)->getId());
    }
}
