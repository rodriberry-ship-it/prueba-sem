<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirplaneResource\Pages;
use App\Filament\Resources\AirplaneResource\RelationManagers;
use App\Models\Airplane;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AirplaneResource extends Resource
{
    protected static ?string $model = Airplane::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('airline_id')
                    ->relationship('airline', 'name')
                    ->required(),

                Forms\Components\TextInput::make('model')
                    ->required(),

                Forms\Components\TextInput::make('capacity')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('registration')
                    ->required(),

                Forms\Components\Toggle::make('active')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('airline.name'),

                Tables\Columns\TextColumn::make('model'),

                Tables\Columns\TextColumn::make('capacity'),

                Tables\Columns\TextColumn::make('registration'),

                Tables\Columns\IconColumn::make('active')
                    ->boolean(),

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
            'index' => Pages\ListAirplanes::route('/'),
            'create' => Pages\CreateAirplane::route('/create'),
            'edit' => Pages\EditAirplane::route('/{record}/edit'),
        ];
    }
}

