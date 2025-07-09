<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use Illuminate\Support\Str; // Pour UUID
use App\Models\Categorie; // Pour la liste des catégories

class VoyageController extends Controller
{
    // Affiche le formulaire
    public function create()
    {
        $categories = Categorie::all(); // Pour le select des catégories
        return view('voyages.create', compact('categories'));
    }

    // Traite la soumission du formulaire
    public function store(Request $request)
{
    // Valide les données du formulaire
    $validated = $request->validate([
        'id_categorie' => 'required|exists:categories,id_categorie',
        'nom_voyage' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'nombre_voyageurs' => 'required|integer|min:1',
        'status' => 'required|string',
        'visibilite' => 'required|boolean',
        'image_couverture' => 'nullable|url',
    ]);

    // Associe le voyage à l'utilisateur connecté
    $validated['id_user'] = auth()->id();

    // Générer un UUID pour l'id_voyage, puisque c’est ta PK
    $validated['id_voyage'] = (string) Str::uuid();

    Voyage::create($validated);

    return redirect()->route('dashboard')->with('success', 'Voyage créé avec succès');
}

public function index()
{
    $voyages = Voyage::latest()->take(3)->get();
    return view('home', compact('voyages'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
