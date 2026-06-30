<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirlineResource\Pages;
use App\Filament\Resources\AirlineResource\RelationManagers;
use App\Models\Airline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AirlineResource extends Resource
{
    protected static ?string $model = Airline::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getCountryOptions(): array
    {
        return [
            'AR' => 'Argentina',
            'BO' => 'Bolivia',
            'BR' => 'Brasil',
            'CL' => 'Chile',
            'CO' => 'Colombia',
            'CR' => 'Costa Rica',
            'CU' => 'Cuba',
            'DO' => 'República Dominicana',
            'EC' => 'Ecuador',
            'SV' => 'El Salvador',
            'GQ' => 'Guinea Ecuatorial',
            'GT' => 'Guatemala',
            'HN' => 'Honduras',
            'MX' => 'México',
            'NI' => 'Nicaragua',
            'PA' => 'Panamá',
            'PY' => 'Paraguay',
            'PE' => 'Perú',
            'PR' => 'Puerto Rico',
            'UY' => 'Uruguay',
            'VE' => 'Venezuela',
            'US' => 'Estados Unidos',
            'CA' => 'Canadá',
            'FR' => 'Francia',
            'DE' => 'Alemania',
            'ES' => 'España',
            'IT' => 'Italia',
            'JP' => 'Japón',
            'CN' => 'China',
            'IN' => 'India',
            'AU' => 'Australia',
        ];
    }
/*
    public static function canViewAny(): bool
    {
        return auth()->user()?->canAccessFilamentResource(self::class);
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canAccessFilamentResource(self::class);
    }*/

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nombre'),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(10)
                    ->label('Código'),
                Forms\Components\Select::make('country')
                    ->required()
                    ->label('País')
                    ->searchable()
                    ->options(self::getCountryOptions()),
                Forms\Components\Toggle::make('status')
                    ->label('Estado')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('code')->label('Código')->searchable(),
                Tables\Columns\TextColumn::make('country')->label('País')->searchable(),
                Tables\Columns\IconColumn::make('status')->label('Estado')->boolean(),
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
            'index' => Pages\ListAirlines::route('/'),
            'create' => Pages\CreateAirline::route('/create'),
            'edit' => Pages\EditAirline::route('/{record}/edit'),
        ];
    }
}
