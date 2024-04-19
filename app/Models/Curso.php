<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'jornada',
        'categoria',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matriculas::class, "id_curso");
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, "id_curso");
    }
}
