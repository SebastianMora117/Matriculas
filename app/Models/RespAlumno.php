<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespAlumno extends Model
{
    protected $table = 'resp_alumnos';
    public $timestamps = false;

    protected $fillable = [
        'nombre_padre',
        'cedula_padre',
        'lugar_expedicionp',
        'telefono_padre',
        'correo_padre',
        'nombre_madre',
        'cedula_madre',
        'lugar_expedicionm',
        'telefono_madre',
        'correo_madre',
        'nombre_acudiente',
        'cedula_acudiente',
        'lugar_expediciona',
        'telefono_acudiente',
        'correo_acudiente',
        'num_identi',
    ];

    public function infAlumno()
    {
        return $this->belongsTo(InfAlumno::class, 'num_identi', 'num_identi');
    }
}
