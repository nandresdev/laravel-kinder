<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;

    protected $fillable = [
        'rut',
        'nombre',
        'telefono',
        'telefono_emergencia',
    ];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class,"id_apoderado");
    }
}
