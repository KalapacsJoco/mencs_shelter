<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use App\Filament\Tables\AnimalTable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListAnimals extends ListRecords
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = AnimalResource::class;

    /**
     * Configure the table displayed on this page.
     *
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns(AnimalTable::getColumns()) // Load columns from AnimalTable class
            ->filters([
                // Add any table filters here
            ])
            ->actions([
                // Add any table actions here
            ]);
    }

    /**
     * Define the actions available in the page header.
     *
     * @return array
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
