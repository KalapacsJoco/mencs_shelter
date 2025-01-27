<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\TextColumn;

/**
 * Class AnimalTable
 *
 * This class defines the table columns for the Animal resource.
 * It provides a reusable configuration for displaying animal-related data
 * in Filament tables.
 */

class AnimalTable
{

    /**
     * Get the columns for the Animal table.
     *
     * This method returns an array of table column definitions,
     * including columns for the animal's name, species, breed, age, and status.
     *
     * @return array The array of table column definitions.
     */

    public static function getColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('species.name'),
            TextColumn::make('breed.name'),
            TextColumn::make('age'),
            TextColumn::make('status'),
        ];
    }
}
