<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GateResource\Pages;
use App\Models\Gate;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;

class GateResource extends Resource
{
    protected static ?string $model = Gate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


   /*ublic static function canViewAny(): bool
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

                TextInput::make('terminal')
                    ->required()
                    ->maxLength(50),

                TextInput::make('gate_number')
                    ->required()
                    ->label('Gate Number'),

                Select::make('status')
                    ->options([
                        'Disponible' => 'Disponible',
                        'Ocupada' => 'Ocupada',
                    ])
                    ->default('Disponible')
                    ->required(),

                Toggle::make('active')
                    ->default(true),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('terminal')
                    ->searchable(),

                TextColumn::make('gate_number')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Disponible',
                        'danger' => 'Ocupada',
                    ]),

                IconColumn::make('active')
                    ->boolean(),

            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGates::route('/'),
            'create' => Pages\CreateGate::route('/create'),
            'edit' => Pages\EditGate::route('/{record}/edit'),
        ];
    }
}