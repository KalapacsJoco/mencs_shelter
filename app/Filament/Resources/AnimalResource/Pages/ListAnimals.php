<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use App\Filament\Tables\AnimalTable;
use App\Traits\ProcessFiles;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Actions\ViewAction;


class ListAnimals extends ListRecords
{

    use ProcessFiles;

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
            ->columns(AnimalTable::getColumns()) 

            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()

                    /**
                     * This function uses a treat witch deletes all the images from database an storage
                     */

                    ->after(function (iterable $records): void {
                        ProcessFiles::bulkDeleteFiles($records);
                    }),
            ]);
    }
}
