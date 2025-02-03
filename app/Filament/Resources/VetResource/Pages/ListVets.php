<?php

namespace App\Filament\Resources\VetResource\Pages;

use App\Filament\Resources\VetResource;
use App\Traits\ProcessFiles;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListVets extends ListRecords
{
    use ProcessFiles;

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = VetResource::class;

    /**
     * This table shows the basic data of all the vets
     */

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('city')->searchable(),
                TextColumn::make('street'),
                TextColumn::make('email'),
                TextColumn::make('phone_number'),
            ])

            ->actions([
                ActionsEditAction::make(),
            ])

            ->bulkActions([
                DeleteBulkAction::make()
                    /**
                     * This function uses a treat witch deletes all the images from database an storage
                     */

                     ->after(function (): void {
                        $this->bulkDeleteFiles();
                    }),
            ]);
    }

    /**
     * This function allowes to add new Vet
     */

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
