<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipo';

    protected $fillable = [
        'nombre', 
        'numIntegrantes', 
        'localizacion'
    ];

    // Obtenemos el registro del locutor que pertenece al equipo
    public function locutores()
    {
        return $this->belongsToMany(Locutor::class, 'locutor_equipo');
    }
}
