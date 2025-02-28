<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PodcastGenero extends Model
{
    protected $table = 'podcast_genero';
    protected $fillable = [
        'podcast_id', 
        'genero_id'
    ];

    // Obtenemos el registro del podcast que pertenece al genero
    public function podcast()
    {
        return $this->belongsTo(Podcast::class)->withDefault();
    }

    // Obtenemos el registro del genero que pertenece al podcast
    public function genero()
    {
        return $this->belongsTo(Genero::class)->withDefault();
    }
}
