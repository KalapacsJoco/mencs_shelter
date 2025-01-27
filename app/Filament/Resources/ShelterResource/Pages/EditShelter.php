<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;


class EditShelter extends EditRecord
{
    protected static string $resource = ShelterResource::class;

        /**
     * This form edits the existing record 
     * @return Form
     */

     public function form(Form $form): Form
     {
         return $form
             ->schema([
                 TextInput::make('name')->required(),
                 TextInput::make('adress')->required(),
                 TextInput::make('phone_number')->required(),
                 TextInput::make('email')->required()->unique(),
                 Textarea::make('description')->required(),
 
                 Repeater::make('images')
                     ->label('Images')
                     ->relationship('images')
                     ->schema([
                         FileUpload::make('path')
                             ->label('Upload Image')
                             ->directory('shelters')
                             ->disk('public'),
                     ])
                     ->minItems(0)
                     ->maxItems(5)
             ]);
     }

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
