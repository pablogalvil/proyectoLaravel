<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'lista';

    protected $fillable = [
        'nombre', 
        'numPodcast', 
        'duracion', 
        'fechaReproduccion', 
        'estado', 
        'descripcion'
    ];

    // Obtenemos el registro del podcast que pertenece a la lista
    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class, 'podcast_lista');
    }
}
