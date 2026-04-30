<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'categorie_id',
        'image',
        'fournisseur_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
    
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}