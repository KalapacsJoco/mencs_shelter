<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Forms\AnimalForm;
use App\Traits\ProcessFiles;
use App\Filament\Resources\AnimalResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{

    use ProcessFiles;

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = AnimalResource::class;

    /**
     * You can find the form logic in the Filament/Forms/AnimalForm.php
     */

    public function form(Form $form): Form
    {
        return $form->schema(AnimalForm::getSchema());
    }

    /**
     * This method will update or delete the files using the ProcessFiles trait
     */

    protected function afterSave(): void
    {
        $this->processFiles();
    }

    /**
     * This function provides to delete the current Animal
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
                    ProcessFiles::deleteFile($this->record);
                }),

        ];
    }
}
