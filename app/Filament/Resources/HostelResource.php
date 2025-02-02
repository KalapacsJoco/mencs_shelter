<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HostelResource\Pages;
use App\Models\Hostel;

class HostelResource extends ResourcesWithNavigationBadge
{

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static ?string $model = Hostel::class;

    /**
     * Defines the resource`s icon
     */

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    /**
     * This function sets the routes for the Vet resource
     */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHostels::route('/'),
            'create' => Pages\CreateHostel::route('/create'),
            'edit' => Pages\EditHostel::route('/{record}/edit'),
            'view' => Pages\ViewHostel::route('/{record}'),
        ];
    }
}
