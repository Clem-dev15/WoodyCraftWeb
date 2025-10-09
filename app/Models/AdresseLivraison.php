<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdresseLivraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ville',
        'departement',
        'nom_rue',
        'numero_rue',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
