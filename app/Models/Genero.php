<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'genero';

    protected $fillable = [
        'nombre', 
        'adulto', 
        'descripcion'
    ];

    // Obtenemos el registro del podcast que pertenece al genero
    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class, 'podcast_genero');
    }
}
