<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassengerResource\Pages;
use App\Filament\Resources\PassengerResource\RelationManagers;
use App\Models\Passenger;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PassengerResource extends Resource
{
    protected static ?string $model = Passenger::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Pasajeros';
    protected static ?string $navigationGroup = 'Recursos';
    protected static ?int $navigationSort = 5;

    /*public static function canViewAny(): bool
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
                Forms\Components\TextInput::make('passport')
                    ->required()
                    ->label('Pasaporte')
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nationality')
                    ->required()
                    ->label('Nacionalidad'),
                Forms\Components\Select::make('flight_id')
                    ->relationship('flight', 'code')
                    ->searchable()
                    ->required()
                    ->label('Vuelo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('passport')->label('Pasaporte')->searchable(),
                Tables\Columns\TextColumn::make('nationality')->label('Nacionalidad')->searchable(),
                Tables\Columns\TextColumn::make('flight.code')->label('Vuelo')->searchable(),
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
            'index' => Pages\ListPassengers::route('/'),
            'create' => Pages\CreatePassenger::route('/create'),
            'edit' => Pages\EditPassenger::route('/{record}/edit'),
        ];
    }
}
