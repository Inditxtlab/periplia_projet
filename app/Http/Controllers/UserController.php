<?php

namespace App\Http\Controllers;

use App\Models\Categorie; 
use App\Models\Voyage; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
public function dashboard(Request $request)
{
    $user = auth()->user();

    $query = $user->voyages()->with('categorie');

    if ($request->filled('categorie')) {
        $query->where('id_categorie', $request->categorie);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $voyages = $query->get();
    $categories = Categorie::all();

    return view('user.dashboard', [
        'voyages' => $voyages,
        'categories' => $categories
    ]);
}
public function profile()
    {
        $user = Auth::user(); // récupère le user connecté
        return view('user.profile', compact('user'));
    }

public function edit()
{
    $user = auth()->user();
    return view('user.edit', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'date_naissance' => 'nullable|date',
        'description_profil' => 'nullable|string',
        'photo_profil' => 'nullable|url',
    ]);

    $user->update($validated);
   

    return redirect()->route('profile.show')->with('success', 'Profil mis à jour.');
}

public function editPassword()
{
    return view('user.password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password'      => ['required'],
        'password'              => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = Auth::user();

    // Vérifie que le mot de passe actuel est correct
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
    }

    // Met à jour le mot de passe
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('profile.show')->with('success', 'Mot de passe mis à jour avec succès.');
}

public function destroy()
{
    $user = auth()->user();

    // Optionnel : déconnecter l'utilisateur avant suppression
    Auth::logout();

    // Supprimer l'utilisateur
    $user->delete();

    // Rediriger vers la page d'accueil ou page de confirmation
    return redirect('/')->with('success', 'Votre compte a bien été supprimé.');
}

}