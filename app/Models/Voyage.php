<?php

namespace App\Models;
use App\Models\Categorie; 
use App\Models\User; 
use App\Models\Activite; 

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $primaryKey = 'id_voyage'; 
    public $incrementing = false; //c'est un UUIDD 
    protected $keyType = 'string';  
    
     protected $fillable = [
        'id_user',
        'id_categorie',
        'nom_voyage',
        'destination',
        'description',
        'date_debut',
        'date_fin',
        'nombre_voyageurs',
        'status',
        'visibilite',
        'image_couverture',
    ];
    
    public function categorie() //Categorie::class C’est la classe du modèle vers lequel la relation pointe. Premier 'id_categorie' (clé étrangère). Deuxième 'id_categorie' (clé primaire locale)
    {
        return $this->belongsTo(Categorie::class, 'id_categorie', 'id_categorie');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function activites()
{
    return $this->hasMany(Activite::class, 'id_voyage', 'id_voyage');
}
}
