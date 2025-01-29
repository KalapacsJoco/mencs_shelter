<?php
namespace App\Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

  /**
     * This funcion lists the basic information about the animals, like name, species, age, etc
     * @param Table $Table
     * @return Table
     */

class AnimalTable
{
    public static function getColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('species.name'),
            TextColumn::make('breed.name'),
            TextColumn::make('age'),
            TextColumn::make('status'),
            TextColumn::make('shelter.name'),
        ];
    }
}
