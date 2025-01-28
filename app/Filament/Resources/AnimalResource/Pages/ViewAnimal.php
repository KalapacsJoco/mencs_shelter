<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;


class ViewAnimal extends ViewRecord
{
    protected static string $resource = AnimalResource::class;

    /**
     * Renders the View page of the selected animal
     */

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')->label('Name:'),
                TextEntry::make('age')->label('Age:'),
                TextEntry::make('color')->label('Color:'),
                TextEntry::make('sex')->label('Sex:'),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'available' => 'primary',
                        'reviewing' => 'warning',
                        'adopted' => 'success',
                        'fostered' => 'info',
                        default => 'secondary',
                    }),

                /**
                 * Todo: figure out why not working
                 */
                TextEntry::make('vaccines')
                    ->label('Vaccines:')
                    ->formatStateUsing(
                        fn($record) =>
                        $record->getRelationValue('vaccines')->pluck('name')->implode(', ')
                    ),
                Textentry::make('message'),
                TextEntry::make('images')
                    ->label('Images')
                    ->html()
                    ->formatStateUsing(
                        fn($record) =>
                        $record->getRelationValue('images')->pluck('path')->map(
                            fn($url) =>
                            "<img src='" . asset('storage/' . $url) . "' width='350' style='border-radius: 10px; margin: 5px;'>"
                        )->implode(' ')
                    ),

                Section::make('Shelter')
                    ->schema([
                        TextEntry::make('shelter.name')
                            ->label('Shelter:'),
                        TextEntry::make('shelter.adress')
                            ->label('Address: ')
                    ])

            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->record($this->getRecord())
        ];
    }
}
