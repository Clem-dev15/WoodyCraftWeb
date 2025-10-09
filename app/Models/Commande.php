<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'user_id',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adresseLivraison()
    {
        return $this->hasOne(AdresseLivraison::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function articles()
    {
        return $this->hasMany(CommandeArticle::class);
    }
}
