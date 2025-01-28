<?php

namespace App\Filament\Resources\ShelterResource\Pages;

use App\Filament\Resources\ShelterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ListShelters extends ListRecords
{
    protected static string $resource = ShelterResource::class;

        /**
     * This funcion lists the basic information about the shelters, like name, adress, phone number, email etc
     * @param Table $Table
     * @return Table
     */

     public function table(Table $table): Table
     {
         return $table
             ->columns([
                 TextColumn::make('name')->searchable(),
                 TextColumn::make('adress')->sortable()->searchable(),
                 TextColumn::make('phone_number'),
                 TextColumn::make('email'),
                 TextColumn::make('description')->limit(50),
                 ImageColumn::make('images.path')
             ])
             ->filters([
                 //
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
                 Tables\Actions\BulkActionGroup::make([]),
             ]);
     }
 
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
