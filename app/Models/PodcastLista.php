<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastLista extends Model
{
    use HasFactory;

    protected $table = 'podcast_lista';

    protected $fillable = [
        'podcast_id', 
        'lista_id'
    ];

    // Obtenemos el registro del podcast que pertenece a la lista
    public function podcast()
    {
        return $this->belongsTo(Podcast::class)->withDefault();
    }

    // Obtenemos el registro de la lista que pertenece al podcast
    public function lista()
    {
        return $this->belongsTo(Lista::class)->withDefault();
    }
}
