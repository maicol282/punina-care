<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        $usuarios = User::paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
       public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cedula' => 'required|string|max:20',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => 'required|string|exists:roles,name',
            'especialidad' => 'nullable|string|max:100',
        ]);

        $cedulaLimpia = preg_replace('/[^0-9]/', '', $validated['cedula']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'cedula' => $cedulaLimpia,
            'cedula_hash' => hash('sha256', $cedulaLimpia),
            'password' => Hash::make($validated['password']),
            'especialidad' => $validated['especialidad'] ?? null,
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, User $usuario)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'cedula' => 'required|string|max:20',
            'role' => 'required|string|exists:roles,name',
            'especialidad' => 'nullable|string|max:100',
        ]);

        $cedulaLimpia = preg_replace('/[^0-9]/', '', $validated['cedula']);

        $usuario->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'cedula' => $cedulaLimpia,
            'cedula_hash' => hash('sha256', $cedulaLimpia),
            'especialidad' => $validated['especialidad'] ?? null,
        ]);

        $usuario->syncRoles([$validated['role']]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

        /**
     * Resetear la contraseña de un usuario (solo para administradores).
     */
        public function resetPassword(Request $request, User $usuario)
    {
        $request->validate([
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Contraseña actualizada correctamente para ' . $usuario->name);
    }
}