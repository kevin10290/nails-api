<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = ['clienta_id', 'servicio_id', 'fecha', 'hora', 'estado'];

    public function clienta()
    {
        return $this->belongsTo(Clienta::class, 'clienta_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
