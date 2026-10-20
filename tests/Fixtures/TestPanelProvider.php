<?php

namespace JeffersonGoncalves\Filament\Skeleton\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\Skeleton\SkeletonPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugin(SkeletonPlugin::make()->animate('pulse')->delay(150));
    }
}
