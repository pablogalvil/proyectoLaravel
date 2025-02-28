<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locutor extends Model
{
    use HasFactory;

    protected $table = 'locutor';

    protected $fillable = [
        'nombre', 
        'edad', 
        'email', 
        'contrasenia', 
        'imagen'
    ];

    // Obtenemos el registro del podcast que pertenece al locutor
    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class, 'podcast_locutor');
    }

    // Obtenemos el registro del equipo que pertenece al locutor
    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'locutor_equipo');
    }
}
