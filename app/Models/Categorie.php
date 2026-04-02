<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';

    protected $fillable = ['nom'];

    public function puzzles()
    {
        return $this->hasMany(\App\Models\Puzzle::class, 'categorie_id');
    }
}