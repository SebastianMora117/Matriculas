<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfAlumno extends Model
{
    protected $table = 'inf_alumnos';
    protected $primaryKey = 'num_identi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'jornada',
        'sede',
        'tipo_identi',
        'num_identi',
        'fecha_nacimiento',
        'grado',
        'grupo',
        'ciudad',
        'departamento',
        'primer_apellido',
        'segundo_apellido',
        'primer_nombre',
        'segundo_nombre',
        'genero',
        'edad',
        'grupo_sanguineo',
        'rh',
        'puntaje_sisben',
        'nivel_sisben',
        'eps',
        'email',
        'ars_ips',
        'localidad',
        'estrato',
        'barrio',
        'direccion',
        'telefono',
        'celular',
        'VDCA',
        'ESDD',
        'HDDDGA',
        'municipio_expulsor',
        'departamento_expulsor',
        'limitaciones',
    ];

    public function historialAcademico()
    {
        return $this->hasOne(HisAcademico::class, 'num_identi', 'num_identi');
    }

    public function responsable()
    {
        return $this->hasOne(RespAlumno::class, 'num_identi', 'num_identi');
    }
}
