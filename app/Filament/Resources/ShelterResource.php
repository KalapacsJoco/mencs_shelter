<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShelterResource\Pages;
use App\Filament\Resources\ShelterResource\RelationManagers;
use App\Models\Image;
use App\Models\Shelter;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ShelterResource extends Resource
{
    protected static ?string $model = Shelter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

 

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->required(),
            TextInput::make('adress')->required(),
            TextInput::make('phone_number')->required(),
            TextInput::make('email')->required()->unique(),
            Textarea::make('description')->required(),
            
            Repeater::make('images') 
            ->label('Images')
            ->relationship('images') 
            ->schema([
                FileUpload::make('path') 
                    ->label('Upload Image')
                    ->directory('shelters') 
                    ->disk('public'),      
            ])
            ->minItems(0)
            ->maxItems(5) 
                // ->afterStateHydrated(function ($component, $state) {
                //     if ($state) {
                //         $name = $component->getForm()->getState()['name'] ?? 'default';
                //         $newFileName = $name . '_' . time() . '.' . $state->getClientOriginalExtension();
                //         $state->storeAs('shelters', $newFileName);
                //     }
                // })
        ]);
    
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([ 
                TextColumn::make('name')->searchable(),
                TextColumn::make('adress')->sortable()->searchable(),
                TextColumn::make('phone_number'),
                TextColumn::make('email'),
                TextColumn::make('description')->limit(50),
                ImageColumn::make('images.path')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                /**
                 * This method deletes all the resource related data from the database and storage
                 * @param $record contains all the resource data
                 */
                    ->after(function ($record) {
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
                
            
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AnimalsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShelters::route('/'),
            'create' => Pages\CreateShelter::route('/create'),
            // 'view' => Pages\ViewShelter::route('/{record}'),
            'edit' => Pages\EditShelter::route('/{record}/edit'),
        ];
    }

}