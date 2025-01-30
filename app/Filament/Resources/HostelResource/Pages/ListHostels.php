<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Resources\HostelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListHostels extends ListRecords
{

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = HostelResource::class;

        /**
     * This table shows the basic data of all the hostels
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
                 EditAction::make(),
             ])
             ->bulkActions([
                 BulkActionGroup::make([
                    DeleteBulkAction::make(),
                 ]),
             ]);
     }

    /**
     * This function allows the header actions of the Hostels
     */

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
