<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMatriculaRequest;
use App\Models\Curso;
use App\Models\Matriculas;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $cursos = Curso::all();
        return view("web.matricula.AddMatricula", [
            "cursos" => $cursos
        ]);
    }

    public function store(AddMatriculaRequest $request)
    {
        $matricula = new Matriculas();
        $matricula->nombre_alumno = $request->input('nombre_alumno');
        $matricula->id_curso = $request->input('id_curso');
        $matricula->nombre_apoderado_principal = $request->input('nombre_apoderado_principal');
        $matricula->telefono_principal = $request->input('telefono_principal');
        $matricula->telefono_emergencia_principal = $request->input('telefono_emergencia_principal');
        $matricula->nombre_apoderado_secundario = $request->input('nombre_apoderado_secundario');
        $matricula->telefono_secundario = $request->input('telefono_secundario');
        $matricula->telefono_emergencia_secundario = $request->input('telefono_emergencia_secundario');
        $matricula->save();
        return response()->json($matricula);
    }
}
