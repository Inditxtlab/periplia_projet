<?php

namespace App\Http\Controllers;

use App\Models\Categorie; 
use App\Models\Voyage; 

use Illuminate\Http\Request;

class UserController extends Controller
{
public function dashboard(Request $request)
{
    $user = auth()->user();

    $voyages = Voyage::with('categorie')
        ->where('id_user', $user->id_user)
        ->when($request->categorie, fn($q) => $q->where('id_categorie', $request->categorie))
        ->when($request->status, fn($q) => $q->where('status', $request->status))
        ->get();

    $categories = Categorie::all(); // Pour les filtres

    return view('user.dashboard', compact('voyages', 'categories'));
}
}