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

/**
 * This method saves the images to the database, because it didnt work automatically
 * @param $this->data contains the data of the resource
 */

    // protected function afterCreate(): void 
    // {
    //     if (isset($this->data['images']) && is_array($this->data['images'])) {
    //         // dd($this->data);
    //         foreach ($this->data['images'] as $filePath) {
    //             Image::create([
    //                 'path' => $filePath, 
    //                 'imageable_type' => Shelter::class, 
    //                 'imageable_id' => $this->record->id, 
    //             ]);
    //         }
    //     }
    // }
    
}
