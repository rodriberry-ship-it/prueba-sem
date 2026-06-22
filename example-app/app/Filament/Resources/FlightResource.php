<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Vuelos';
    protected static ?string $navigationGroup = 'Panel';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(20)
                    ->label('Código de vuelo'),
                Forms\Components\Select::make('airline_id')
                    ->relationship('airline', 'name')
                    ->searchable()
                    ->required()
                    ->label('Aerolínea'),
                Forms\Components\Select::make('airplane_id')
                    ->relationship('airplane', 'registration')
                    ->searchable()
                    ->required()
                    ->label('Avión'),
                Forms\Components\Select::make('gate_departure_id')
                    ->relationship('departureGate', 'gate_number')
                    ->searchable()
                    ->required()
                    ->label('Gate de salida'),
                Forms\Components\Select::make('gate_arrival_id')
                    ->relationship('arrivalGate', 'gate_number')
                    ->searchable()
                    ->required()
                    ->label('Gate de llegada'),
                Forms\Components\Select::make('origin_id')
                    ->relationship('origin', 'name')
                    ->searchable()
                    ->required()
                    ->label('Salida'),
                Forms\Components\Select::make('destination_id')
                    ->relationship('destination', 'name')
                    ->searchable()
                    ->required()
                    ->label('Llegada'),
                Forms\Components\DateTimePicker::make('departure_time')
                    ->required()
                    ->label('Hora de salida'),
                Forms\Components\DateTimePicker::make('arrival_time')
                    ->required()
                    ->label('Hora de llegada'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Código')->searchable(),
                Tables\Columns\TextColumn::make('airline.name')->label('Aerolínea')->searchable(),
                Tables\Columns\TextColumn::make('airplane.registration')->label('Avión')->searchable(),
                Tables\Columns\TextColumn::make('departureGate.gate_number')->label('Gate de salida')->searchable(),
                Tables\Columns\TextColumn::make('arrivalGate.gate_number')->label('Gate de llegada')->searchable(),
                Tables\Columns\TextColumn::make('origin.name')->label('Origen')->searchable(),
                Tables\Columns\TextColumn::make('destination.name')->label('Destino')->searchable(),
                Tables\Columns\TextColumn::make('departure_time')->label('Salida')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('arrival_time')->label('Llegada')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->dateTime()->sortable()->toggleable(),
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
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
