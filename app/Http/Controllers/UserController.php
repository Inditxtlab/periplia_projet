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

}