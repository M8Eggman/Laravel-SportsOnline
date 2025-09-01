<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $factory = [
        'name'
    ];

    public function joueur(){
        return $this->hasMany(Joueur::class);
    }


}
