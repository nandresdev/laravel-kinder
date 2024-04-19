<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_curso',
        'id_alumno',
        'id_user',
        'estado',
        'fecha',
    ];


    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function matriculas()
    {
        return $this->belongsTo(Matriculas::class, "id_alumno");
    }
    public function usuarios()
    {
        return $this->belongsTo(User::class, "id_user");
    }
}
