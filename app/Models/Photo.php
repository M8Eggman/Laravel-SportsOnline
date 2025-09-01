<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'src'
    ];

    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }
}
