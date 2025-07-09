<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'description' => $request->description,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'date_naissance' => $request->date_naissance,
        'password' => Hash::make($request->password),
    ]);

    auth()->login($user);

    return redirect()->route('home');
}

}