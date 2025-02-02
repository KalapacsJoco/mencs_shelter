<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Resources\Concerns\ProcessFiles;
use App\Filament\Resources\HostelResource;
use Filament\Actions;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewHostel extends ViewRecord
{
    use ProcessFiles;

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = HostelResource::class;

    /**
     * Renders the View page of the selected hostel.
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
                TextEntry::make('tags.name')
                    ->listWithLineBreaks()
                    ->bulleted(),

                ImageEntry::make('images.path')
                    ->size(250),

                RepeatableEntry::make('schedule')
                    ->schema([
                        TextEntry::make('day_of_week')->label('')->formatStateUsing(fn($state) => ucfirst($state)),
                        TextEntry::make('start_time')->label(''),
                        TextEntry::make('end_time')->label(''),
                    ])
                    ->columns([
                        'md' => '3',
                        's' => '1'
                    ])
                    ->columnSpan(1),
            ]);
    }

    /**
     * This function allows to edit or delete the actual hostel
     * @return array[]
     */

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Edit hostel'),
            Actions\DeleteAction::make()->label('Delete hostel')

                /**
                 * This method calls a trait, that deletes all the files from the storage and database
                 * @return void
                 */

                ->after(function (): void {
                    $this->processFiles();
                }),
        ];
    }
}
