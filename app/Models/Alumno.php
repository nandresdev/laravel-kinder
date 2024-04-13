<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'id_apoderado',
        'id_curso',
        'matricula',
    ];

    public function apoderados()
    {
        return $this->belongsTo(Apoderado::class, "id_apoderado");
    }

    public function cursos()
    {
        return $this->belongsTo(Curso::class, "id_curso");
    }
}
