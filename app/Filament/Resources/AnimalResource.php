<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimalResource\Pages;
use App\Models\Animal;

class AnimalResource extends ResourcesWithNavigationBadge
{

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static ?string $model = Animal::class;

    /**
     * Defines the resource`s icon
     */

    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';

    /**
     * This function sets the routes for the Vet resource
     */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
            'view' => Pages\ViewAnimal::route('/{record}'),
        ];
    }
}
