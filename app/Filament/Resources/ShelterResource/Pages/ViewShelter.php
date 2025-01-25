<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Page;

class ViewShelter extends ViewRecord
{
    protected static string $resource = ShelterResource::class;

    

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),  
            Actions\Action::make('add_new_animal')  
                ->label('Add New Animal')  
        //         ->url(fn () => route('filament.resources.animals.create', ['shelter_id' => $this->record->id]))
        ];
    }

    

    
}
