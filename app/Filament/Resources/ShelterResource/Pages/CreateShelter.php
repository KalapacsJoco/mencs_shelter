<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;


use Filament\Resources\Pages\CreateRecord;

class CreateShelter extends CreateRecord
{
    protected static string $resource = ShelterResource::class;

    /**
     * This class handles listing, creating, and updating Shelter records
     *  It also provides
     * functionalities to delete associated images from storage upon record removal.
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
 
}
