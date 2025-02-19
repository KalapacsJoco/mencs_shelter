<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
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
                TextEntry::make('vaccines.name')
                    ->listWithLineBreaks()
                    ->bulleted(),
                Textentry::make('message'),
                ImageEntry::make('images.path'),

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
