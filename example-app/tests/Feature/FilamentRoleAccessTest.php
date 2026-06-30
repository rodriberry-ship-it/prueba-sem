<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FilamentRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_specific_roles_can_access_their_allowed_resources(): void
    {
        foreach (['Administración de Empleados', 'Pilotos', 'Jefatura', 'Desarrollador Web'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        $employeeUser = User::factory()->create();
        $employeeUser->assignRole('Administración de Empleados');

        $this->assertTrue($employeeUser->canAccessFilamentResource(\App\Filament\Resources\EmployeeResource::class));
        $this->assertFalse($employeeUser->canAccessFilamentResource(\App\Filament\Resources\FlightResource::class));

        $pilotUser = User::factory()->create();
        $pilotUser->assignRole('Pilotos');

        $this->assertTrue($pilotUser->canAccessFilamentResource(\App\Filament\Resources\FlightResource::class));
        $this->assertFalse($pilotUser->canAccessFilamentResource(\App\Filament\Resources\AirplaneResource::class));

        $managerUser = User::factory()->create();
        $managerUser->assignRole('Jefatura');

        $this->assertTrue($managerUser->canAccessFilamentResource(\App\Filament\Resources\FlightResource::class));
        $this->assertTrue($managerUser->canAccessFilamentResource(\App\Filament\Resources\AirplaneResource::class));
        $this->assertTrue($managerUser->canAccessFilamentResource(\App\Filament\Resources\GateResource::class));
    }
}
