<?php

namespace App\Policies;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PacientePolicy
{
    /**
     * Determinar si el usuario puede ver el paciente.
     */
    public function view(User $user, Paciente $paciente): bool
    {
        // Admin y Médicos pueden ver todos los pacientes
        return $user->hasAnyRole(['Administrador', 'Médico']);
    }

    /**
     * Determinar si el usuario puede crear pacientes.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Administrador', 'Médico']);
    }

    /**
     * Determinar si el usuario puede actualizar el paciente.
     */
    public function update(User $user, Paciente $paciente): bool
    {
        return $user->hasAnyRole(['Administrador', 'Médico']);
    }

    /**
     * Determinar si el usuario puede eliminar el paciente.
     */
    public function delete(User $user, Paciente $paciente): bool
    {
        return $user->hasRole('Administrador');
    }
}
