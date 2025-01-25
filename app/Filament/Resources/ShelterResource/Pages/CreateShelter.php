<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use App\Models\Image;
use App\Models\Shelter;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShelter extends CreateRecord
{
    protected static string $resource = ShelterResource::class;

    protected function afterCreate(): void // szerintem letezik elegansabb megoldas is
    {
        if (isset($this->data['image']) && is_array($this->data['image'])) {
            foreach ($this->data['image'] as $filePath) {
                Image::create([
                    'path' => $filePath, 
                    'imageable_type' => Shelter::class, 
                    'imageable_id' => $this->record->id, 
                ]);
            }
        }
    }
    
}
