<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Forms\ShelterForm;
use App\Filament\Resources\ShelterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Traits\ProcessFiles;
use Filament\Forms\Form;

class EditShelter extends EditRecord
{
    use ProcessFiles;

    protected static string $resource = ShelterResource::class;

        /**
     * This form edits the existing Shelter record 
     * @return Form
     */

     public function form(Form $form): Form
     {
         return $form->schema(ShelterForm::getSchema());
     }

     /**
      * This function deletes the images selected by the user from the database and storage
      */

     protected function afterSave(): void
     {
         $this->processFiles();
     }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            /**
             * This method deletes all the resource related data from the database and storage
             * @param $record contains all the resource data
             */
            ->after(function () {
                ProcessFiles::deleteFile($this->record);
            }),
        ];
    }

}
