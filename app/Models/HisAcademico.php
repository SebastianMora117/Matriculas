<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HisAcademico extends Model
{
    protected $table = 'his_academico';
    public $timestamps = false;

    protected $fillable = [
        'ha_año',
        'ha_grado',
        'ha_institucion',
        'ha_localidad',
        'ha_categoria',
        'ha_año1',
        'ha_grado1',
        'ha_institucion1',
        'ha_localidad1',
        'ha_categoria1',
        'ha_año2',
        'ha_grado2',
        'ha_institucion2',
        'ha_localidad2',
        'ha_categoria2',
        'ha_año3',
        'ha_grado3',
        'ha_institucion3',
        'ha_localidad3',
        'ha_categoria3',
        'num_identi',
    ];

    public function infAlumno()
    {
        return $this->belongsTo(InfAlumno::class, 'num_identi', 'num_identi');
    }
}
