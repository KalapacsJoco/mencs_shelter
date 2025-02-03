<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Define the form schema for creating/updating Vet records.
 * Includes fields for basic info,
 * name, email, address etc
 */

class VetForm
{

    /**
     * This form modifyes the selected Vet instance
     */

    public static function getSchema(): array
    {
        return [
            Section::make('Personal informations')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Adress: ')
                        ->required(),
                    TextInput::make('phone_number')
                        ->required(),
                    TextInput::make('city')
                        ->required(),
                    TextInput::make('street')
                        ->required(),
                    Section::make('Images')
                        ->schema([
                            FileUpload::make('images')
                                ->label('')
                                ->multiple()
                                ->disk('public')
                                ->directory('vets')
                                ->image()
                                ->afterStateHydrated(function (callable $set, $state, $record) {
                                    if ($record) {
                                        $set('images', $record->images->pluck('path')->toArray());
                                    }
                                })
                                ->getUploadedFileNameForStorageUsing(
                                    fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend(rand(1, 1000)),
                                )
                        ])
                        ->collapsible()
                        ->columnSpan(1),

                ])
                ->columnSpan(1),

            Section::make('Secvices')
                ->schema([
                    Select::make('services')
                        ->multiple()
                        ->relationship('services', 'name')
                        ->preload()
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('New Service Name')
                                ->required(),
                        ])
                        ->required(),
                    Section::make('Schedule')
                        ->schema([
                            Repeater::make('schedules')
                                ->relationship('schedules')
                                ->schema([
                                    Select::make('day_of_week')
                                        ->options([
                                            'monday'   => 'Monday',
                                            'tuesday'  => 'Tuesday',
                                            'wednesday' => 'Wednesday',
                                            'thursday' => 'Thursday',
                                            'friday'   => 'Friday',
                                            'saturday' => 'Saturday',
                                            'sunday'   => 'Sunday',
                                        ])
                                        ->required(),

                                    Select::make('schedule_status')
                                        ->options([
                                            'closed'   => 'Closed',
                                            'set_time' => 'Set Time',
                                        ])
                                        ->live()
                                        ->default('closed')
                                        ->required()
                                        ->hidden(fn(callable $get) => $get('schedule_status') == 'set_time'),

                                    TimePicker::make('start_time')
                                        ->label('From')
                                        ->format('H:i')
                                        ->seconds(false)
                                        ->required()
                                        ->hidden(fn(callable $get) => $get('schedule_status') !== 'set_time'),

                                    TimePicker::make('end_time')
                                        ->label('To')
                                        ->format('H:i')
                                        ->seconds(false)
                                        ->required()
                                        ->hidden(fn(callable $get) => $get('schedule_status') !== 'set_time'),
                                ])
                                ->columns(3),
                        ])
                        ->columnSpan(1),

                ])
                ->columnSpan(1),

        ];
    }
}
