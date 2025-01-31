<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Forms\HostelForm;
use App\Filament\Resources\HostelResource;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateHostel extends CreateRecord
{

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
}
