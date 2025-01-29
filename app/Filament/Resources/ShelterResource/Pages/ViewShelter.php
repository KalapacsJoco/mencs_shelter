<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewShelter extends ViewRecord
{
    protected static string $resource = ShelterResource::class;

    /**
 * Configure the infolist schema for viewing shelter details.
 *
 * @param \Filament\Infolists\Infolist $infolist The infolist instance to configure.
 * @return \Filament\Infolists\Infolist The configured infolist instance.
 */

    public function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            TextEntry::make('name')->label('Shelter Name'),
            TextEntry::make('location')->label('Location'),
            TextEntry::make('description')->label('Description'),
        ]);
}

/**
 * Get the header actions for the "View Shelter" page.
 *
 * Includes actions such as editing the shelter or adding a new animal.
 *
 * @return array The list of actions available on the header.
 */

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),  
            Actions\Action::make('add_new_animal')  
                ->label('Add New Animal')  
        ];
    }

    

    
}
