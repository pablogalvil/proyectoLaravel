<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentario';

    protected $fillable = [
        'descripcion', 
        'fecha', 
        'user_id', 
        'podcast_id'
    ];

    // Obtenemos el registro del usuario que pertenece al comentario
    /*public function usuario()
    {
        return $this->belongsTo(User::class);
    }*/
    // Comentario.php
public function usuario()
{
    return $this->belongsTo(User::class, 'user_id'); 
}


    // Obtenemos el registro del podcast que pertenece al comentario
    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
