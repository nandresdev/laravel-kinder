<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriculas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_alumno',
        'nombre_apoderado_principal',
        'telefono_principal',
        'telefono_emergencia_principal',
        'nombre_apoderado_secundario',
        'telefono_secundario',
        'telefono_emergencia_secundario',
        'matricula',
        'id_curso'

    ];

    public function cursos()
    {
        return $this->belongsTo(Curso::class, "id_curso");
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, "id_alumno");
    }
}
