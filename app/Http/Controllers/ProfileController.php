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
}