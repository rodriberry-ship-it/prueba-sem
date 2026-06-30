<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as FilamentDashboard;

class Dashboard extends FilamentDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $slug = 'dashboard';

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user && ($user->hasRole('Jefatura') || $user->hasRole('Desarrollador Web') || $user->hasRole('Administración de Empleados') || $user->hasRole('Pilotos'));
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
