<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VetResource\Pages;
use App\Models\Vet;
use Filament\Resources\Resource;

class VetResource extends Resource
{
    protected static ?string $model = Vet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    /**
     * This function sets the routes for the Vet resource
     */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVets::route('/'),
            'create' => Pages\CreateVet::route('/create'),
            'edit' => Pages\EditVet::route('/{record}/edit'),
        ];
    }
}
