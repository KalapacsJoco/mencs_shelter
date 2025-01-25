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
        $customPanel->resources([
            ShelterResource::class, // Ebben nem vagyok biztos, hogy igy kell, de csak igy tudtam behozni
        ]);
        return $customPanel;
    }
}
