<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

/**
 * Class AnimalForm
 *
 * This class defines the form schema for creating and updating Animal records.
 * It provides a reusable configuration for Filament forms, including fields for:
 * - Basic animal information (name, age, color, sex, status, message)
 * - Relationships (species, breed, vaccines)
 * - Repeater for image uploads
 * The schema allows dynamic creation of related entities, such as species, breeds, and vaccines,
 * directly from the form.
 */

class AnimalForm
{

    /**
     * Get the form schema for the Animal resource.
     *
     * This method returns an array of form components that define the input fields
     * and their configurations. The schema includes:
     * - Text inputs for basic animal details
     * - Select components with relationships for species, breed, and vaccines
     * - A repeater for uploading multiple images
     * - Options for sex and status
     *
     * @return array The form schema as an array of components.
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

        ];
    }
}
