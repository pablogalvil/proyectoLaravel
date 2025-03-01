<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocutorEquipo extends Model
{
    use HasFactory;

    protected $table = 'locutor_equipo';

    protected $fillable = [
        'id_locutor',
        'id_equipo',
    ];

    // Obtenemos el registro del locutor que pertenece al equipo
    public function locutor()
    {
        return $this->belongsTo(Locutor::class);
    }

    // Obtenemos el registro del equipo que pertenece al locutor
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
