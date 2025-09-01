<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    use HasFactory;
    protected $fillable =[
        'first_name','last_name', 'age', 'phone', 'email', 'city'
    ];

    public function photo(){
        return $this->hasOne(Photo::class, 'joueur_id');
    }
    public function equipe(){
        return $this->belongsTo(Equipe::class);
    }
    public function position(){
        return $this->belongsTo(Position::class);
    }
    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
