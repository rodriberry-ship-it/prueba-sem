<?php

namespace App\Filament\Widgets;

use App\Models\Flight;
use Filament\Widgets\Widget;

class FlightsWidget extends Widget
{
    protected static string $view = 'filament.widgets.flights-widget';

    protected function getViewData(): array
    {
        return [
            'flights' => Flight::with(['airline', 'airplane', 'departureGate', 'arrivalGate', 'origin', 'destination'])
                ->orderByDesc('departure_time')
                ->limit(5)
                ->get(),
        ];
    }
}
