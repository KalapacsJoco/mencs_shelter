<?php

namespace App\Filament\Resources\HostelResource\Pages;

use App\Filament\Resources\HostelResource;
use Illuminate\Support\Facades\Storage;
use Filament\Actions;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewHostel extends ViewRecord
{

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
                TextEntry::make('services.name')
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
                 * This method deletes all the resource related data from the database and storage
                 * @param $record contains all the resource data
                 * @return void
                 */

                ->after(function (Model $record): void {
                    $images = $record->images;
                    if ($images) {
                        foreach ($images as $image) {
                            if ($image->path && Storage::disk('public')->exists($image->path)) {
                                Storage::disk('public')->delete($image->path);
                            }
                            $image->delete();
                        }
                    }
                }),
        ];
    }
}
