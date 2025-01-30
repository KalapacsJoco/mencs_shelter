<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Resources\HostelResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateHostel extends CreateRecord
{

    /**
     * The associated Filament resource for this page.
     * 
     * @var string
     */

    protected static string $resource = HostelResource::class;

    /**
     * This form creates a new Hostel instance
     */

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hostel basics')
                    ->schema([
                        Textinput::make('name'),
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
                        ])
                    ])
                    ->columnSpan(1),

                Section::make('Schedule')
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
                
                Section::make('Upload photos')
                    ->schema([
                        Repeater::make('images')
                            ->label('Images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('path')
                                    ->label('Upload Image')
                                    ->directory('hostels')
                                    ->disk('public'),
                            ])
                            ->minItems(0)
                            ->maxItems(5)
                            ->addActionLabel('Add Image'),
                    ])
                    ->columnSpan(1),


            ]);
    }
}
