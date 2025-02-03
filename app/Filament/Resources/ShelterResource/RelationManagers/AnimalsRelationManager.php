<?php

namespace App\Filament\Resources\ShelterResource\RelationManagers;

use App\Filament\Forms\AnimalForm;
use App\Filament\Resources\AnimalResource\Pages\CreateAnimal;
use App\Filament\Resources\AnimalResource\Pages\EditAnimal;
use App\Filament\Tables\AnimalTable;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Manages the "animals" relation within the Shelter resource.
 * 
 * This class handles listing, creating, and updating Animal records
 * that are related to a specific Shelter entry. It also provides
 * functionalities to delete associated images from storage upon record removal.
 */

class AnimalsRelationManager extends RelationManager
{

    /**
     * The name of the Eloquent relationship on the resource.
     *
     * @var string
     */

    protected static string $relationship = 'animals';

    /**
     * You can find the form logic in the Filament/Forms/AnimalForm.php
     */

    public function form(Form $form): Form
    {
        return $form->schema(AnimalForm::getSchema());
    }

    /**
     * You can find the table logic in the Filament/Tables/AnimalTables.php 
     */

    public function table(Table $table): Table
    {
        return $table
            ->columns(AnimalTable::getColumns())

            ->actions([
                Tables\Actions\EditAction::make()->url(fn($record) => EditAnimal::getUrl(['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->url(fn() => CreateAnimal::getUrl(['shelter' => $this->ownerRecord->id])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
