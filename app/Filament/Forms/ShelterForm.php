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
 * Define the form schema for creating/updating Shelter records.
 * Includes fields for basic info,
 * name, address, phone number, schedule and image uploads.
 */

class ShelterForm
{

    /**
     * This form can update or edit the Shelter instance
     * @return array[]
     */
    public static function getSchema(): array
    {
        return [
            TextInput::make('name')->required(),
            TextInput::make('city')->required(),
            TextInput::make('street')->required(),
            TextInput::make('phone_number')->required(),
            TextInput::make('email')->required(),
            Textarea::make('description')->required(),

            Section::make('Images')
                ->schema([
                    FileUpload::make('images')
                        ->label('')
                        ->multiple()
                        ->disk('public')
                        ->directory('shelters')
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
                ->columnSpan(1)
        ];
    }
}
