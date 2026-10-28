<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User; // <-- AGREGAR ESTO

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

       public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Si viene cédula, limpiamos y recalculamos el hash
        if (!empty($data['cedula'])) {
            $cedulaLimpia = preg_replace('/[^0-9]/', '', $data['cedula']);
            $data['cedula'] = $cedulaLimpia;
            $data['cedula_hash'] = hash('sha256', $cedulaLimpia);
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ============================================
    // MÉTODOS PARA FIRMA DIGITAL
    // ============================================

    /**
     * Update the user's digital signature.
     */
    public function updateFirma(Request $request): RedirectResponse
    {
        $request->validate([
            'firma' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        if ($user->firma_path) {
            Storage::disk('public')->delete($user->firma_path);
        }
        
        $path = $request->file('firma')->store('firmas', 'public');
        $user->firma_path = $path;
        $user->save();
        
        return redirect()->back()->with('status', 'Firma actualizada correctamente.');
    }

    /**
     * Delete the user's digital signature.
     */
    public function deleteFirma(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->firma_path) {
            Storage::disk('public')->delete($user->firma_path);
            $user->firma_path = null;
            $user->save();
        }
        
        return redirect()->back()->with('status', 'Firma eliminada correctamente.');
    }
        public function updateCertificado(Request $request): RedirectResponse
    {
                $request->validate([
            'certificado' => 'required|file|max:2048', // <-- Quitamos 'mimes' para evitar el bloqueo
            'certificado_password' => 'required|string',
        ]);
        
        // Validación manual de la extensión
        $extension = $request->file('certificado')->getClientOriginalExtension();
        if (!in_array(strtolower($extension), ['p12', 'pfx'])) {
            return back()->withErrors(['certificado' => 'El archivo debe ser un certificado .p12 o .pfx válido.']);
        }

        $user = $request->user();

        // Eliminar el anterior si existe
        if ($user->certificado_p12) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($user->certificado_p12);
        }

        // Guardar el nuevo en storage/app/certificados
        $path = $request->file('certificado')->store('certificados', 'local');
        
        $user->certificado_p12 = $path;
        $user->certificado_password = $request->certificado_password;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'certificado-updated');
    }

    public function deleteCertificado(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->certificado_p12) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($user->certificado_p12);
            $user->certificado_p12 = null;
            $user->certificado_password = null;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'certificado-deleted');
    }
}