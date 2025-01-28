<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

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
    public static function getSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Select::make('species_id')
                ->label('Species')
                ->relationship('species', 'name')
                ->createOptionForm([
                    TextInput::make('name')
                        ->label('New Species Name')
                        ->required(),
                ])
                ->searchable()
                ->required(),

            Select::make('breed_id')
                ->label('Breed')
                ->relationship('breed', 'name')
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->label('New Breed Name'),
                    Select::make('species_id')
                        ->label('Species')
                        ->relationship('species', 'name')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('New Species Name')
                                ->required(),
                        ])
                        ->searchable()
                        ->required(),
                ])
                ->searchable()
                ->required(),

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

            Repeater::make('vaccines')
                ->label('Vaccines')
                ->schema([
                    TextInput::make('vaccine_name')
                        ->label('Vaccine Name'),
                    TextInput::make('dose')
                        ->label('Dose')
                        ->numeric()
                        ->nullable(),
                ])
                ->required()
                ->collapsible()
                ->addActionLabel('Add Vaccine')
                ->columns(2),

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
