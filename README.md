<div class="filament-hidden">

<!-- banner: art/jeffersongoncalves-filament-skeleton.png (generate via portfolio-banner skill) -->

</div>

# Filament Skeleton

Automatic [Flux](https://fluxui.dev/components/skeleton)-style skeleton loading states for Filament infolists, plus `skeleton`, `skeleton.line` and `skeleton.group` Blade components.

Register the plugin and every infolist turns into a shimmering skeleton while its Livewire component is busy (polling, `$refresh`, running an action), without touching your resources. No build step and no `filament:assets`: the plugin inlines ~3 KB of plain CSS and JS in the panel `<head>`.

## Compatibility

| Plugin | Filament |
|--------|----------|
| 1.x    | 3.x      |
| 2.x    | 4.x      |
| 3.x    | 5.x      |

## Installation

```bash
composer require jeffersongoncalves/filament-skeleton
```

## Usage

```php
use JeffersonGoncalves\Filament\Skeleton\SkeletonPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(SkeletonPlugin::make());
}
```

Options:

```php
SkeletonPlugin::make()
    ->animate('pulse') // 'shimmer' (default), 'pulse' or null for a static skeleton
    ->delay(300);      // ms a request must run before the skeleton shows (default 200), so fast responses don't flash
```

### When the skeleton shows

The skeleton is shown for a Livewire request that calls a method (`wire:poll`, `$refresh`, running a mounted action, ...) on a component that contains infolist entries. Requests that only open or close an action modal (`mountAction`, `unmountAction`, ...) and requests that only sync form state are ignored, so opening a modal doesn't blank the page behind it.

### Opting out

Add `data-no-skeleton` to an entry, or to any parent component, to keep it out of the skeleton:

```php
TextEntry::make('status')
    ->extraAttributes(['data-no-skeleton' => true]);

Section::make('Live data')
    ->extraAttributes(['data-no-skeleton' => true])
    ->schema([...]);
```

### Blade components

A port of `flux:skeleton`, usable in custom pages, widgets or as a lazy-loading placeholder:

```blade
<x-filament-skeleton::skeleton.group animate="shimmer" class="flex items-center gap-4">
    <x-filament-skeleton::skeleton class="size-10 rounded-full" />

    <div class="flex-1">
        <x-filament-skeleton::skeleton.line />
        <x-filament-skeleton::skeleton.line size="lg" class="w-1/2" />
    </div>
</x-filament-skeleton::skeleton.group>
```

The components rely on the CSS the plugin injects, so use them inside a panel that registers the plugin.

### Content Security Policy

When a CSP nonce is set through `Vite::useCspNonce()`, the inlined `<style>` and `<script>` tags carry it.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
