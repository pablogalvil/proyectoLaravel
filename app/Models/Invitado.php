<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitado extends Model
{
    use HasFactory;

    protected $table = 'invitado';

    protected $fillable = [
        'nombre', 
        'ocupacion', 
        'imagen', 
        'descripcion'
    ];

    // Obtenemos el registro del podcast que pertenece al invitado
    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class, 'podcast_invitado');
    }
}
