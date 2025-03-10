<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episodio extends Model
{
    use HasFactory;

    protected $table = 'episodio';

    protected $fillable = [
        'titulo', 
        'audio', 
        'descripcion', 
        'podcast_id'
    ];

    // Obtenemos el registro del podcast que pertenece al episodio
    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

        // Método para obtener la URL completa del archivo de audio
        public function getAudioUrl()
        {
            return asset('audio/' . $this->audio);
        }
    
}
