<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'commande_id',
        'methode',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
