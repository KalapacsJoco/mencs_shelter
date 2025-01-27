<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ShelterResource;
use Filament\Panel;
use Minic\FilamentStarterKit\Providers\Filament\AdminPanelProvider as MinicAdminPanelProvider;

class AdminPanelProvider extends MinicAdminPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $customPanel = parent::panel($panel);
        return $customPanel;
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
		// ...
        ];
    }

}
