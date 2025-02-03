<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Forms\HostelForm;
use App\Traits\ProcessFiles;
use App\Filament\Resources\HostelResource;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateHostel extends CreateRecord
{

    /**
     * This trait contains the logic of saving and deleting the images after the form is saved or Delete button pressed
     */

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
     * This method uses the ProcessFiles trait to save the images after the form being saved
     */

    protected function afterCreate(): void
    {
        $this->processFiles(); 
    }

}
