<?php

namespace App\Http\Controllers;

use App\Models\Categorie; 
use App\Models\Voyage; 
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

use Auth;
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
    ]);

    $user->update($validated);

    return redirect()->route('user.edit')->with('success', 'Profil mis à jour.');
}

public function editPassword()
{
    return view('user.password');
}

public function updatePassword(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if (!$user || !is_string($user->password) || !\Hash::check($request->current_password, $user->password)) {
    return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
}

    $user->password = \Hash::make($request->password);
    $user->save();

    return redirect()->route('user.password.edit')->with('success', 'Mot de passe mis à jour.');
}
}