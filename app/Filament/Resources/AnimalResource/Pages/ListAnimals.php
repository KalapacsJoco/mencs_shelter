<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use App\Filament\Tables\AnimalTable;
use Filament\Actions;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

/**
 * This Table show all the animals found in the database
 */

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    /**
     * You can find the table logic in the Filament/Tables/AnimalTable.php
     */

    public function table(Table $table): Table
    {
        return $table
        ->columns(AnimalTable::getColumns())
            ->filters([
                //
            ])
            ->actions([

            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
