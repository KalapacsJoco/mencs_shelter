<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShelterResource\Pages;
use App\Filament\Resources\ShelterResource\RelationManagers;
use App\Models\Image;
use App\Models\Shelter;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShelterResource extends Resource
{
    protected static ?string $model = Shelter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('address')->required(),
                TextInput::make('phone_number')->required(),
                TextInput::make('email')->required()->unique(),
                Textarea::make('description')->required(),
    
                FileUpload::make('imageable')
                ->label('Shelter Image')
                ->image()
                ->directory('shelters')
                ->multiple()
                ->maxParallelUploads(1)
                ->nullable()
                ->disk('public')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        foreach ($state as $file) {
                            // Tároljuk a fájlt
                            $path = $file->store('shelters', 'public');
            
                            // Kép létrehozása az Image táblában (imageable_id = null)
                            Image::create([
                                'path' => $path,
                                'imageable_type' => Shelter::class,
                                'imageable_id' => null, // Ideiglenesen null marad
                            ]);
                            $set('imageable', []);
                        }
                       
                    }
                })
                
                                        
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
                ImageColumn::make('image')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShelters::route('/'),
            'create' => Pages\CreateShelter::route('/create'),
            'edit' => Pages\EditShelter::route('/{record}/edit'),
        ];
    }
}