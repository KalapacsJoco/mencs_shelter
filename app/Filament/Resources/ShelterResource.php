<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShelterResource\Pages;
use App\Filament\Resources\ShelterResource\RelationManagers;
use App\Models\Shelter;
use Filament\Resources\Resource;

class ShelterResource extends Resource
{
    protected static ?string $model = Shelter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * Manages relations between Shelter an Animals
     * @return array
     */

    public static function getRelations(): array
    {
        return [
            RelationManagers\AnimalsRelationManager::class,
        ];
    }

    /**
     * Resource routes
     * @return array
     */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShelters::route('/'),
            'create' => Pages\CreateShelter::route('/create'),
            'view' => Pages\ViewShelter::route('/{record}'),
            'edit' => Pages\EditShelter::route('/{record}/edit'),
        ];
    }
}
