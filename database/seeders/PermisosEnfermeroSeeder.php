<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisosEnfermeroSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear los permisos que faltan (si no existen)
        $permisosNuevos = [
            'ver recetas',
            'ver certificados',
        ];

        foreach ($permisosNuevos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // 2. Obtener el rol Enfermero
        $rol = Role::where('name', 'Enfermero')->first();

        if ($rol) {
            // 3. Definir los permisos exactos para Enfermero
            $permisosEnfermero = [
                'ver pacientes',
                'ver historiales',
                'crear historiales',   // Para signos vitales y alergias
                'ver recetas',
                'ver certificados',
            ];

            // 4. Sincronizar permisos (elimina los que no están y agrega los nuevos)
            $rol->syncPermissions($permisosEnfermero);

            echo "✅ Permisos actualizados para el rol Enfermero: " . implode(', ', $permisosEnfermero) . PHP_EOL;
        } else {
            echo "❌ Rol Enfermero no encontrado." . PHP_EOL;
        }
    }
}