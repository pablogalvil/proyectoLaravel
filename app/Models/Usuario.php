<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $fillable = [
        'nombre', 
        'contrasenia', 
        'email', 
        'fechaRegistro', 
        'imagen'
    ];

    // Obtenemos el registro del comentario que pertenece al usuario
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
