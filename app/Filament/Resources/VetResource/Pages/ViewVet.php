<?php

namespace App\Filament\Resources\VetResource\Pages;

use App\Filament\Resources\VetResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\ImageEntry;

class ViewVet extends ViewRecord
{
    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = VetResource::class;

    /**
     * Renders the View page of the selected vet.
     * 
     * @param Infolist $infolist
     * @return Infolist
     */

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')->label('Name:'),
                TextEntry::make('email')->label('Email address:'),
                TextEntry::make('phone_number')->label('Phone number:'),
                TextEntry::make('city')->label('City:'),
                TextEntry::make('street')->label('Street:'),
                TextEntry::make('services.name')
                    ->listWithLineBreaks()
                    ->bulleted(),
                ImageEntry::make('images.path'),

                Grid::make()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('schedules.day_of_week')
                            ->label('Days of the week')
                            ->columnStart(1)
                            ->listWithLineBreaks()
                            ->bulleted(),
                        TextEntry::make('schedules.start_time')
                            ->label('From')
                            ->columnStart(2)
                            ->listWithLineBreaks(),
                        TextEntry::make('schedules.end_time')
                            ->label(('To'))
                            ->columnStart(3)
                            ->listWithLineBreaks()
                    ])
                    ->columnSpan(1)
            ]);
    }

    /**
     * This function allows to edit the actual vet
     * @return array[]
     */

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
        ];
    }
}
