<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VetResource\Pages;
use App\Models\Vet;
use Filament\Resources\Resource;

class VetResource extends Resource
{

            /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static ?string $model = Vet::class;

    /**
     * Selected heroicon for this page
     */

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
            'view' => Pages\ViewVet::route('/{record}'),
        ];
    }
}
