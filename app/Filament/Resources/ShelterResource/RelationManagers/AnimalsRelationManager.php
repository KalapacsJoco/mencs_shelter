<?php

namespace App\Filament\Resources\ShelterResource\RelationManagers;

use App\Filament\Forms\AnimalForm;
use App\Filament\Tables\AnimalTable;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
