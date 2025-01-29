<?php

namespace App\Filament\Resources\VetResource\Pages;

use App\Filament\Resources\VetResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateVet extends CreateRecord
{
    protected static string $resource = VetResource::class;

    /**
     * This form creates a new Vet instance
     */

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                            ->required()

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
                    ])
                    ->columnSpan(1),

                Section::make('Upload Photos')
                    ->schema([
                        Repeater::make('images')
                            ->label('Images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('path')
                                    ->label('Upload Image')
                                    ->directory('vets')
                                    ->disk('public'),
                            ])
                            ->minItems(0)
                            ->maxItems(5)
                            ->addActionLabel('Add Image'),
                    ])
                    ->columnSpan(1),

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
                                    ->label('Schedule')
                                    ->options([
                                        'closed'   => 'Closed',
                                        'set_time' => 'Set Time',
                                    ])
                                    ->live()
                                    ->default('closed')
                                    ->required(),

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
                            ->defaultItems(7)
                            ->columns(3),
                    ])
                    ->columnSpan(1),
            ]);
    }
}
