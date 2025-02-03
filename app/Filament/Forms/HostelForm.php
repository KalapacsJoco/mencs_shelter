<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Define the form schema for creating/updating Hostel records.
 * Includes fields for basic info,
 * name, address, phone number, schedule and image uploads.
 */

class HostelForm
{

    /**
     * This form can update or edit the Hostel instance
     * @return array[]
     */
    public static function getSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('name'),
                    Textinput::make('email'),
                    Textinput::make('phone_number'),
                    Textinput::make('city'),
                    Textinput::make('street'),
                    Textarea::make('description'),
                    Select::make('tags')
                        ->multiple()
                        ->relationship('tags', 'name')
                        ->preload()
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('New Tag Name')
                                ->required(),
                        ]),
                    Section::make('Images')
                        ->schema([
                            FileUpload::make('images')
                                ->label('')
                                ->multiple()
                                ->disk('public')
                                ->directory('hostels')
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

                ])
                ->columnSpan(1),

            Section::make()
                ->schema([
                    Repeater::make('schedule')
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

                            TimePicker::make('start_time')
                                ->label('From')
                                ->format('H:i')
                                ->seconds(false)
                                ->required(),

                            TimePicker::make('end_time')
                                ->label('To')
                                ->format('H:i')
                                ->seconds(false)
                                ->required(),
                        ])
                        ->columns(3),
                ])
                ->columnSpan(1),

        ];
    }
}
