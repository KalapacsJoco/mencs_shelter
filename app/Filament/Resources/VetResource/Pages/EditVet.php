<?php

namespace App\Filament\Resources\VetResource\Pages;

use App\Filament\Forms\VetForm;
use App\Filament\Resources\VetResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class EditVet extends EditRecord
{

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
     * This function allows to delete the current Vet
     */

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()

                /**
                 * This method deletes all the resource related data from the database and storage
                 * @param $record contains all the resource data
                 * @return void
                 */

                ->after(function (Model $record): void {
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
