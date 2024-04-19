<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Alumno;
use App\Models\Apoderado;
use Illuminate\Http\Request;
use App\Http\Requests\AddAlumnoRequest;
use App\Http\Requests\EditAlumnoRequest;
use App\Models\Matriculas;

class AlumnoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos = Matriculas::all();
        return view("web.alumno.listAlumno", [
            "alumnos" => $alumnos
        ]);
    }

    public function show($id)
    {
        $alumno = Matriculas::findOrFail($id);
        return view("web.alumno.showAlumno", [
            "alumno" => $alumno
        ]);
    }
}
