<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clienta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha_nacimiento', 'correo', 'contraseña', 'estado'];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'clienta_id');
    }
}
