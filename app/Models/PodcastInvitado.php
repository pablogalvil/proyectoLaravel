<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastInvitado extends Model
{
    use HasFactory;

    protected $table = 'podcast_invitado';

    protected $fillable = [
        'podcast_id',
        'invitado_id',
    ];

    // Obtenemos el registro del invitado que pertenece al podcast
    public function invitado()
    {
        return $this->belongsTo(Invitado::class)->withDefault();
    }

    // Obtenemos el registro del podcast que pertenece al invitado
    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
