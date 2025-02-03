<?php

namespace App\Filament\Forms;

use App\Models\Breed;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;

  /**
     * Define the form schema for creating/updating Animal records.
     * Includes fields for basic info,
     * species, breed, vaccines (repeater), and image uploads.
     *
     * @param  Form  $form
     * @return Form
     */

class AnimalForm
{

    /**
     * This form fills the Animal`s data
     */
    public static function getSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Select::make('species_id')
                ->label('Species')
                ->relationship('species', 'name')
                ->live()
                ->createOptionForm([
                    TextInput::make('name')
                        ->label('New Species Name')
                        ->required(),
                ])
                ->required(),    
            
            Select::make('breed_id')
                ->label('Breed')
                ->relationship('breed', 'name')
                ->options(fn (Get $get) => $get('species_id') ? Breed::where('species_id', $get('species_id'))->pluck('name', 'id') : [])
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->label('New Breed Name'),
                ])
                ->required()
                ->disabled(fn (Get $get) => !$get('species_id')),

            TextInput::make('age')
                ->required()
                ->numeric()
                ->minValue(1)
                ->maxValue(99),

            TextInput::make('color')
                ->required()
                ->maxLength(255),

            Radio::make('sex')
                ->options([
                    'male' => 'male',
                    'female' => 'female',
                ])
                ->required(),

            Select::make('status')
                ->options([
                    'available' => 'available',
                    'adopted' => 'adopted',
                    'fostered' => 'fostered'
                ])
                ->required(),

            Select::make('vaccines')
                ->label('Vaccines')
                ->multiple() 
                ->relationship('vaccines', 'name') 
                ->preload() 
                ->searchable() 
                ->createOptionForm([
                    TextInput::make('name')
                        ->label('New Vaccine Name') 
                        ->required(),
                ])
                ->required(),

            Textarea::make('message')
                ->required(),

            Repeater::make('images')
                ->label('Images')
                ->relationship('images')
                ->schema([
                    FileUpload::make('path')
                        ->label('Upload Image')
                        ->directory('animals')
                        ->disk('public'),
                ])
                ->minItems(0)
                ->maxItems(5)
                ->addActionLabel('Add Image'),

        ];
    }
}
