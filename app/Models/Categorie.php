<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    // Si la table ne s'appelle pas "categories" par défaut, précise-la :
    protected $table = 'categories'; // ou 'categorie' selon ta table

    public function puzzles()
    {
        return $this->hasMany(Puzzle::class, 'categorie_id'); 
        // Remplace 'categorie_id' par le nom exact de la colonne FK dans ta table puzzles
    }
}
