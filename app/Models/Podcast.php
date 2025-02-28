<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model
{
    use HasFactory;

    protected $table = 'podcast';

    protected $fillable = [
        'duracion', 
        'nombre', 
        'imagen', 
        'descripcion', 
        'fechaPublicacion'
    ];

    // Obtenemos el registro del episiodio que pertenece al podcast
    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    // Obtenemos el registro del comentario que pertenece al podcast
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    // Obtenemos el registro del locutor que pertenece al podcast
    public function locutores()
    {
        return $this->belongsToMany(Locutor::class, 'podcast_locutor');
    }

    // Obtenemos el registro del genero que pertenece al podcast
    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'podcast_genero');
    }

    // Obtenemos el registro de la lista que pertenece al podcast
    public function listas()
    {
        return $this->belongsToMany(Lista::class, 'podcast_lista');
    }

    // Obtenemos el registro del invitado que pertenece al podcast
    public function invitados()
    {
        return $this->belongsToMany(Invitado::class, 'podcast_invitado');
    }
}