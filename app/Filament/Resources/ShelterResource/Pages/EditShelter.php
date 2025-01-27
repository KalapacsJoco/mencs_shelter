<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditShelter extends EditRecord
{
    protected static string $resource = ShelterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            /**
             * This method deletes all the resource related data from the database and storage
             * @param $record contains all the resource data
             */
                ->after(function ($record) {
                    $images = $record->images; 
                    if ($images) {
                        foreach ($images as $image) {
                            if ($image->path && Storage::disk('public')->exists($image->path)) {
                                Storage::disk('public')->delete($image->path);
                            }
                            $image->delete();
                        }
                    }
                }),
        ];
    }


}
