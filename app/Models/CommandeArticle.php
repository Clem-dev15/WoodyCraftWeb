<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeArticle extends Model
{
    protected $fillable = [
        'commande_id',
        'nom',
        'quantite',
        'prix',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
