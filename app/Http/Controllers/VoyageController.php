<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use Illuminate\Support\Str; // Pour UUID
use App\Models\Categorie; // Pour la liste des catégories
use App\Models\Activite; 


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
            'visibilite' => 'required|in:0,1',
            'image_couverture' => 'nullable|url',
        ]);

        if (auth()->check()) {
            $validated['id_user'] = auth()->id();
            $validated['id_voyage'] = (string) Str::uuid();
            $validated['status'] = 'a_venir'; // valeur par défaut

            if (empty($validated['image_couverture'])) {
                $validated['image_couverture'] = url('assets/images/default-voyage.jpg');
            }


            Voyage::create($validated);

            return redirect()->route('voyages.show', $validated['id_voyage'])->with('success', 'Voyage créé avec succès');
        }
        ;

        // Sinon, stocke les données dans la session
        session()->put('voyage_temp', $validated);

        return redirect()->route('register')->with('message', 'Crée ton compte pour sauvegarder ton voyage !');
    }

    public function index()
    {
        $voyages = Voyage::latest()->take(3)->get();
        return view('home', compact('voyages'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id_voyage)
    {
        $voyage = Voyage::with('categorie', 'user')->findOrFail($id_voyage);

        $activitesParJour = Activite::where('id_voyage', $voyage->id_voyage)
            ->orderBy('date')
            ->orderBy('heure_debut')
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            });
        // Passe $activitesParJour à la vue
        return view('voyages.show', compact('voyage', 'activitesParJour'));
    }

    public function edit($id_voyage)
    {
        $voyage = Voyage::findOrFail($id_voyage);
        $categories = Categorie::all();
        return view('voyages.edit', compact('voyage', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_voyage)
    {
        $voyage = Voyage::findOrFail($id_voyage);

        // Vérifie que l'utilisateur est le propriétaire du voyage
        if (auth()->id() !== $voyage->id_user) {
            abort(403, 'Accès non autorisé');
        }

        $validated = $request->validate([
            'id_categorie' => 'required|exists:categories,id_categorie',
            'nom_voyage' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'nombre_voyageurs' => 'required|integer|min:1',
            'visibilite' => 'required|in:0,1',
            'image_couverture' => 'nullable|url',
        ]);

        $voyage->update($validated);

        return redirect()->route('voyages.show', $voyage->id_voyage)->with('success', 'Voyage mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_voyage)
    {
        $voyage = Voyage::findOrFail($id_voyage);

        if (auth()->id() !== $voyage->id_user) {
            abort(403, 'Action non autorisée');

        }

        $voyage->delete();

        return redirect()->route('dashboard')->with('success', 'Le voyage a été supprimé avec succès.');
    }


    //Methode toggleVisibilite 

    public function toggleVisibilite($id_voyage)
    {
        $voyage = Voyage::findOrFail($id_voyage);

        if (auth()->id() !== $voyage->id_user) {
            return response()->json(['error' => 'Non autorisé.'], 403);
        }

        $voyage->visibilite = $voyage->visibilite ? 0 : 1;
        $voyage->save();

        return response()->json([
            'success' => true,
            'visibilite' => $voyage->visibilite
        ]);
    }
}