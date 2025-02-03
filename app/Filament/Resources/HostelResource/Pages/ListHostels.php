<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Traits\ProcessFiles;
use App\Filament\Resources\HostelResource;
use App\Models\Hostel;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;

class ListHostels extends ListRecords
{
    use ProcessFiles;

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
            ->filters([
                SelectFilter::make('city')
                    ->label('City')
                    ->options(
                        fn() => Hostel::query()
                            ->distinct()
                            ->pluck('city', 'city')
                            ->toArray()
                    )
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->after(function (iterable $records): void {
                        ProcessFiles::bulkDeleteFiles($records);
                    }),
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
