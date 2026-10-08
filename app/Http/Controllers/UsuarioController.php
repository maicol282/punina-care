<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método auxiliar para verificar si es administrador
    private function verificarAdmin()
    {
        if (!auth()->user() || !auth()->user()->hasRole('Administrador')) {
            abort(403, 'Acceso denegado. Solo el Administrador puede gestionar usuarios.');
        }
    }

    public function index()
    {
        $this->verificarAdmin();
        $usuarios = User::with('roles')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $this->verificarAdmin();
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->verificarAdmin();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'especialidad' => 'nullable|string|max:100'
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        $usuario->assignRole($request->role);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario registrado exitosamente.');
    }

    public function edit(User $usuario)
    {
        $this->verificarAdmin();
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $this->verificarAdmin();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role' => 'required|exists:roles,name',
            'especialidad' => 'nullable|string|max:100'
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $usuario->syncRoles([$request->role]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $usuario)
    {
        $this->verificarAdmin();
        
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}