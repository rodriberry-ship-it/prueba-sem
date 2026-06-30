<?php

namespace App\Filament\Concerns;

use Illuminate\Support\Facades\Auth;

trait HasRoleBasedAccess
{
    protected static function canAccessResource(array $allowedRoles = []): bool
    {
        $user = Auth::user();

        if (! $user) {
            return false;
        }

        if ($user->hasRole('Jefatura') || $user->hasRole('Desarrollador Web')) {
            return true;
        }

        if (empty($allowedRoles)) {
            return false;
        }

        return $user->hasAnyRole($allowedRoles);
    }
}
