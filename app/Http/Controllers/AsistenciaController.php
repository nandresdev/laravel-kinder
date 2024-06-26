<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Curso;
use App\Models\Asistencia;
use App\Models\Matriculas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\AsitenciasExport;
use App\Http\Requests\AddAsistenciasRequest;

class AsistenciaController extends Controller
{

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
    }

    public function index()
    {
        $asistencias = Asistencia::select('fecha', 'id_curso')->groupBy('fecha', 'id_curso')->get();

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

    public function show($fecha, $id_curso)
    {
        $asistencias = Asistencia::where('fecha', $fecha)
            ->where('id_curso', $id_curso)
            ->get();

        return view("web.asistencias.showAsistencias", [
            'asistencias' => $asistencias,
            'fecha' => $fecha,
            'id_curso' => $id_curso,
        ]);
    }

    public function destroy($fecha, $id_curso)
    {
        Asistencia::where('fecha', $fecha)
            ->where('id_curso', $id_curso)
            ->delete();

        return response()->json(['message' => 'Asistencias del curso eliminadas correctamente'], 200);
    }

    public function exportExcel($fecha, $id_curso)
    {
        $curso = Curso::find($id_curso);
        $nombreDelCurso = $curso ? $curso->nombre : 'curso';
        $nombreArchivo = "listadoAsistencias_{$nombreDelCurso}_{$fecha}.xlsx";
        $nombreArchivo = str_replace(['/', '\\', ' '], '_', $nombreArchivo);

        $export = new AsitenciasExport($fecha, $id_curso);
        return $this->excel->download($export, $nombreArchivo);
    }


    public function exportPdf($fecha, $id_curso)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $asistencias = Asistencia::where('fecha', $fecha)
            ->where('id_curso', $id_curso)
            ->get();

        $view = view('pdf.listAsistenciaPdf', [
            'asistencias' => $asistencias,
            'fecha' => $fecha,
            'id_curso' => $id_curso
        ])->render();

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);
        $dompdf->render();

        return $dompdf->stream("listadoAsistencia_{$fecha}_{$id_curso}.pdf");
    }
}
