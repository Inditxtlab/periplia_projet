<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'document',
        'type_doc',
    ];

    /**
     * Relation one-to-one avec User (un document appartient à un seul utilisateur)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
        // belongsTo(modèle lié, clé étrangère dans documents, clé primaire dans users)
    }
}
