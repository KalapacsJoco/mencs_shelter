<?php

namespace App\Filament\Resources\VetResource\Pages;

use App\Filament\Forms\VetForm;
use App\Filament\Resources\VetResource;
use App\Traits\ProcessFiles;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateVet extends CreateRecord
{
    use ProcessFiles;

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = VetResource::class;

    /**
     * You can find the form logic in the Filament/Forms/VetForm.php
     */

    public function form(Form $form): Form
    {
        return $form->schema(VetForm::getSchema());
    }

    /**
     * This method uses the ProcessFiles trait to save the images after the form being saved
     */

    protected function afterCreate(): void
    {
        $this->processFiles();
    }
}
