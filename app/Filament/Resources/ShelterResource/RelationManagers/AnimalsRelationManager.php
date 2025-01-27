<?php

namespace App\Filament\Resources\ShelterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class AnimalsRelationManager extends RelationManager
{
    protected static string $relationship = 'animals';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
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
                        // ->required(),
                        TextInput::make('dose')
                            ->label('Dose')
                            ->numeric()
                            ->nullable(),
                    ])
                    ->required()
                    ->collapsible()
                    ->createItemButtonLabel('Add Vaccine')
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
                    ->createItemButtonLabel('Add Image'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('species.name'),
                TextColumn::make('breed.name'),
                TextColumn::make('age'),
                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
