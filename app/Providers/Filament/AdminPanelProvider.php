<?php

namespace App\Providers\Filament;

use App\Filament\Resources\AnimalResource;
use App\Filament\Resources\HostelResource;
use App\Filament\Resources\ShelterResource;
use App\Filament\Resources\VetResource;
use Filament\Panel;
use Minic\FilamentStarterKit\Providers\Filament\AdminPanelProvider as MinicAdminPanelProvider;

class AdminPanelProvider extends MinicAdminPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $customPanel = parent::panel($panel);
        return $customPanel
            ->sidebarCollapsibleOnDesktop()
            ->brandLogo(asset('storage/logo/logo.png'));
    }

        /**
     * Register the resources for the admin panel.
     *
     * @return array Array of the resources to be registered in the admin panel
     */
    public function resources(): array
    {
        return [
            ShelterResource::class,
            AnimalResource::class,
            VetResource::class,
            HostelResource::class,
		// ...
        ];
    }

}
