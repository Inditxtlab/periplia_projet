<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Voyage;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

public function showRegistrationForm()
{
    return view('auth.register');

}

public function register(Request $request)
{
    $request->validate([
        'description' => 'nullable|string|max:500',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'date_naissance' => 'required|date',
        'password' => 'required|string|min:4|confirmed',
        'photo_profil' => 'nullable|url',
    ]);

    $user = User::create([
        'description' => $request->description,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'date_naissance' => $request->date_naissance,
        'photo_profil' => $request->photo_profil,
        'password' => Hash::make($request->password),
    ]);

    auth()->login($user);

    // S’il y a un voyage temporaire dans la session, on le crée maintenant
    if (session()->has('voyage_temp')) {
        $voyageData = session()->get('voyage_temp');
        $voyageData['id_user'] = $user->id_user;
        $voyageData['status'] = 'a_venir';
        $voyageData['id_voyage'] = (string) Str::uuid();

        $voyage = Voyage::create($voyageData);

        // Nettoyer la session
        session()->forget('voyage_temp');

        return redirect()->route('voyages.show', $voyage->id_voyage)
            ->with('success', 'Ton compte et ton voyage ont été créés avec succès !');
    }

    // Sinon, rediriger normalement
    return redirect()->route('dashboard')
        ->with('success', 'Compte créé avec succès !');
}
}