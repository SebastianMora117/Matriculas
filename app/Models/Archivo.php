<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    // Decirle a Laravel los nombres reales de las columnas
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'tipo_archivo',
        'tarjetaIdentidad',
        'ruta',
        'nombre_original',
    ];
}