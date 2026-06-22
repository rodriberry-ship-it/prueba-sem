<?php

namespace App\Filament\Resources\AirplaineResource\Pages;

use App\Filament\Resources\AirplaineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirplaines extends ListRecords
{
    protected static string $resource = AirplaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
