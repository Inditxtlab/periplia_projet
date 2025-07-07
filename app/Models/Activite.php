<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date',
        'lieu',
        'description',
        'heure_debut',
        'heure_fin',
        'id_voyage',
    ];

    /**
     * Une activité appartient à un seul voyage
     */
    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'id_voyage', 'id_voyage');
    }
}
