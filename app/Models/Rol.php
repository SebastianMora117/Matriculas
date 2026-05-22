<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table      = 'roles';
    protected $fillable   = ['nombre', 'estado'];
    public    $timestamps = false; // la tabla usa fecha_creacion, no created_at/updated_at

    protected $casts = [
        'fecha_creacion' => 'date',
    ];
}