<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    protected $fillable = [
        'nom',
        'categorie_id',
        'description',
        'image',
        'prix',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class);
    }
}
