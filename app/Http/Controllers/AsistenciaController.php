<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAsistenciasRequest;
use App\Models\User;
use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\Matriculas;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $asistencias = Asistencia::select('fecha')->groupBy('fecha')->get();
        return view("web.asistencias.listAsistencias", [
            "asistencias" => $asistencias
        ]);
    }

    public function create()
    {
        $cursos = Curso::all();
        return view("web.asistencias.addAsistencias", [
            "cursos" => $cursos,
        ]);
    }

    public function obtenerAlumnosPorCurso(Request $request)
    {
        $alumnos = Matriculas::where('id_curso', $request->id_curso)->get();
        return response()->json($alumnos);
    }

    public function store(AddAsistenciasRequest $request)
    {
        $datosFormulario = $request->all();
        $idAlumnos = $datosFormulario['id_alumno'];
        $estados = $datosFormulario['estado'];
        $cursoId = $datosFormulario['id_curso'];
        $fecha = $datosFormulario['fecha'];

        foreach ($idAlumnos as $key => $idAlumno) {
            $asistencia = new Asistencia();
            $asistencia->id_curso = $cursoId;
            $asistencia->id_alumno = $idAlumno;
            $asistencia->estado = $estados[$key];
            $asistencia->fecha = $fecha;
            $asistencia->save();
        }

        return response()->json($asistencia);
    }




    public function show(string $id)
    {
    }


    public function edit(string $id)
    {
    }


    public function update(Request $request, string $id)
    {
    }


    public function destroy($fecha)
    {
        Asistencia::where('fecha', $fecha)->delete();
        return response()->json(['message' => 'Asistencias eliminadas correctamente'], 200);
    }
}
