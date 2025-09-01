<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'city','genre'
    ];

    public function continent(){
        return $this->belongsTo(Continent::class);
    }
    public function genre(){
        return $this->belongsTo(Genre::class);
    }
    public function joueur(){
        return $this->hasMany(Joueur::class);
    }

}
