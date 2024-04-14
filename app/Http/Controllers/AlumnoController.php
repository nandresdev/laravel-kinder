<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Alumno;
use App\Models\Apoderado;
use Illuminate\Http\Request;
use App\Http\Requests\AddAlumnoRequest;
use App\Http\Requests\EditAlumnoRequest;

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

    public function edit($id)
    {
        $apoderados = Apoderado::all();
        $cursos = Curso::all();
        $alumno = Alumno::findOrFail($id);

        return view("web.alumno.EditAlumno", [
            "apoderados" => $apoderados,
            "cursos" => $cursos,
            "alumno" => $alumno
        ]);
    }

    public function update(EditAlumnoRequest $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->nombre = $request->input('nombre');
        $alumno->id_curso = $request->input('id_curso');
        $alumno->id_apoderado = $request->input('id_apoderado');
        $alumno->save();

        return response()->json($alumno);
    }

    public function destroy(string $id)
    {
    }
}
