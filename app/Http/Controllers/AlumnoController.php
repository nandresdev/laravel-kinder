<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAlumnoRequest;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\Curso;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos = Alumno::all();
        return view("web.alumno.listAlumno", [
            "alumnos" => $alumnos
        ]);
    }

    public function create()
    {
        $apoderados = Apoderado::all();
        $cursos = Curso::all();
        return view("web.alumno.AddAlumno", [
            "apoderados" => $apoderados,
            "cursos" => $cursos
        ]);
    }

    public function store(AddAlumnoRequest $request)
    {
        $alumno = new Alumno();
        $alumno->nombre = $request->input('nombre');
        $alumno->id_curso = $request->input('id_curso');
        $alumno->id_apoderado = $request->input('id_apoderado');
        $alumno->save();

        return response()->json($alumno);
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}
