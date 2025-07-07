<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    use HasFactory;

    protected $primaryKey = 'id_categorie'; 
    protected $fillable = ['titre', 'description', 'slug']; 

    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'id_categorie', 'id_categorie');
    }
}