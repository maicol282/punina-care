<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Resetear roles y permisos cacheados
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definir permisos
        $permissions = [
            'ver pacientes',
            'crear pacientes',
            'editar pacientes',
            'eliminar pacientes',
            'ver historiales',
            'crear historiales',
            'editar historiales',
            'eliminar historiales',
            'ver seguimientos',
            'crear seguimientos',
            'editar seguimientos',
            'eliminar seguimientos',
        ];

        // Crear permisos SOLO si no existen (usando firstOrCreate)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
            $this->command->info("✅ Permiso '{$permission}' verificado/creado");
        }

        // Crear roles SOLO si no existen
        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $doctorRole = Role::firstOrCreate(['name' => 'Médico', 'guard_name' => 'web']);
        $enfermeroRole = Role::firstOrCreate(['name' => 'Enfermero', 'guard_name' => 'web']);

        $this->command->info('✅ Roles creados/verificados');

        // Sincronizar permisos (esto reemplaza los existentes en lugar de duplicar)
        $adminRole->syncPermissions(Permission::all());
        $this->command->info("✅ Permisos asignados a 'Administrador'");

        // Asignar permisos al médico (incluye eliminar pacientes)
        $doctorRole->syncPermissions([
            'ver pacientes',
            'crear pacientes',
            'editar pacientes',
            'eliminar pacientes',
            'ver historiales',
            'crear historiales',
            'editar historiales',
            'ver seguimientos',
            'crear seguimientos',
            'editar seguimientos',
        ]);
        $this->command->info("✅ Permisos asignados a 'Médico'");

        // Asignar permisos al enfermero (NO incluye eliminar pacientes)
        $enfermeroRole->syncPermissions([
            'ver pacientes',
            'ver historiales',
            'ver seguimientos',
            'crear seguimientos',
        ]);
        $this->command->info("✅ Permisos asignados a 'Enfermero'");

        // Crear o actualizar usuarios
        $this->crearUsuarios();
    }

    private function crearUsuarios()
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@hospital.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        
        if (!$admin->hasRole('Administrador')) {
            $admin->assignRole('Administrador');
            $this->command->info("✅ Rol 'Administrador' asignado a admin@hospital.com");
        } else {
            $this->command->info("⚠️  Usuario admin@hospital.com ya tiene el rol");
        }

        // Médico
        $medico = User::firstOrCreate(
            ['email' => 'medico@hospital.com'],
            [
                'name' => 'Dr. Médico',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        
        if (!$medico->hasRole('Médico')) {
            $medico->assignRole('Médico');
            $this->command->info("✅ Rol 'Médico' asignado a medico@hospital.com");
        } else {
            $this->command->info("⚠️  Usuario medico@hospital.com ya tiene el rol");
        }

        // Enfermero
        $enfermero = User::firstOrCreate(
            ['email' => 'enfermero@hospital.com'],
            [
                'name' => 'Enf. Enfermero',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        
        if (!$enfermero->hasRole('Enfermero')) {
            $enfermero->assignRole('Enfermero');
            $this->command->info("✅ Rol 'Enfermero' asignado a enfermero@hospital.com");
        } else {
            $this->command->info("⚠️  Usuario enfermero@hospital.com ya tiene el rol");
        }
    }
}