<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $factory = [
        'name', 'city'
    ];

    public function continent(){
        return $this->belongsTo(Continent::class);
    }
    public function joueur(){
        return $this->hasMany(Joueur::class);
    }

}
