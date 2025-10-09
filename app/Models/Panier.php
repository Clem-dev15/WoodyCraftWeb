<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $fillable = ['user_id', 'nom', 'quantite', 'prix', 'puzzle_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
