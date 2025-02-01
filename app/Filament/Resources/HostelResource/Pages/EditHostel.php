<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Forms\HostelForm;
use App\Filament\Resources\Concerns\ProcessFiles;
use App\Filament\Resources\HostelResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditHostel extends EditRecord
{

    use ProcessFiles;

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = HostelResource::class;

    /**
     * You can find the form logic in the Filament/Forms/HostelForm.php
     */

    public function form(Form $form): Form
    {
        return $form->schema(HostelForm::getSchema());
    }

    /**
     * This method will update or delete the files using the ProcessFiles trait
     */

    protected function afterSave(): void
    {
        $this->processFiles();
    }

    /**
     * This function provides to delete the current Hostel
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

                ->after(function (): void {
                    $this->processFiles();
                }),
        ];
    }
}
