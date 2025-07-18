<?php

namespace App\Http\Controllers;

use App\Models\Activite; 
use App\Models\Voyage; 
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_voyage' => 'required|exists:voyages,id_voyage',
            'titre' => 'required',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'lieu' => 'nullable',
            'type' => 'nullable'
        ]);
        Activite::create($request->all());
        return back();
    }

  public function update(Request $request, Activite $activite)
{
    $validated = $request->validate([
        'titre' => 'required',
        'date' => 'required|date',
        'heure_debut' => 'required',
        'heure_fin' => 'required|after:heure_debut',
        'lieu' => 'nullable',
        'description'=> 'nullable', 
        'type' => 'nullable',
    ]);

    $activite->update($validated);
    return back()->with('success', 'Activité mise à jour avec succès.');

}

    public function destroy(Activite $activite)
    {
        $activite->delete();
        return back();
    }
}
