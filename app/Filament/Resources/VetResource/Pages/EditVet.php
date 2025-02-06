<?php

namespace App\Filament\Resources\VetResource\Pages;

use App\Filament\Forms\VetForm;
use App\Filament\Resources\VetResource;
use App\Traits\ProcessFiles;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditVet extends EditRecord
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
     * This method will update or delete the files using the ProcessFiles trait
     */

    protected function afterSave(): void
    {
        $this->processFiles();
    }

    /**
     * This function allows to delete the current Vet
     */

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                /**
                 * This method uses the ProcessFiles trait to delete all the resource related data from the database and storage
                 * @param $record contains all the resource data
                 * @return void
                 */

                 ->after(function () {
                    $this->deleteFile();
                }),
        ];
    }
}
