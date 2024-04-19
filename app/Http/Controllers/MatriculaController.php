<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMatriculaRequest;
use App\Http\Requests\EditMatriculaRequest;
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
        return view("web.matricula.addMatricula", [
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

    public function edit($id)
    {
        $alumno = Matriculas::findOrFail($id);
        $cursos = Curso::all();
        return view('web.matricula.editMatricula', [
            "alumno" => $alumno,
            "cursos" => $cursos
        ]);
    }

    public function update(EditMatriculaRequest $request, $id)
    {
        $alumno = Matriculas::findOrFail($id);
        $alumno->nombre_alumno = $request->input('nombre_alumno');
        $alumno->id_curso = $request->input('id_curso');
        $alumno->nombre_apoderado_principal = $request->input('nombre_apoderado_principal');
        $alumno->telefono_principal = $request->input('telefono_principal');
        $alumno->telefono_emergencia_principal = $request->input('telefono_emergencia_principal');
        $alumno->nombre_apoderado_secundario = $request->input('nombre_apoderado_secundario');
        $alumno->telefono_secundario = $request->input('telefono_secundario');
        $alumno->telefono_emergencia_secundario = $request->input('telefono_emergencia_secundario');
        $alumno->save();
        return response()->json($alumno);
    }

    public function destroy(Matriculas $alumno)
    {
        $alumno->delete();
        return response()->json(['message' => 'Matricula eliminada correctamente'], 200);
    }
}
