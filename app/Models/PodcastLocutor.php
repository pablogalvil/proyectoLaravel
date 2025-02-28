<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastLocutor extends Model
{
    use HasFactory;

    protected $table = 'podcast_locutor';

    protected $fillable = [
        'podcast_id', 
        'locutor_id'
    ];

    // Obtenemos el registro del podcast que pertenece al locutor
    public function podcast()
    {
        return $this->belongsTo(Podcast::class)->withDefault();
    }

    // Obtenemos el registro del locutor que pertenece al podcast
    public function locutor()
    {
        return $this->belongsTo(Locutor::class)->withDefault();
    }
}
