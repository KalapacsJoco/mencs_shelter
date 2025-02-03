<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Forms\ShelterForm;
use App\Filament\Resources\ShelterResource;
use App\Traits\ProcessFiles;
use Filament\Forms\Form;

use Filament\Resources\Pages\CreateRecord;

class CreateShelter extends CreateRecord
{
    use ProcessFiles;

    protected static string $resource = ShelterResource::class;

    /**
     * This class handles listing, creating, and updating Shelter records
     */

    public function form(Form $form): Form
    {
        return $form->schema(ShelterForm::getSchema());
    }

    /**
     * This method uses the ProcessFiles trait to save the images after the form being saved
     */

    protected function afterCreate(): void
    {
        $this->processFiles();
    }
}
