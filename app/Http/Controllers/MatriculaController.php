<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Curso;
use App\Models\Matriculas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\AlumnosExport;
use App\Http\Requests\AddMatriculaRequest;
use App\Http\Requests\EditMatriculaRequest;


class MatriculaController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
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

    public function exportExcel()
    {
        return $this->excel->download(new AlumnosExport, 'listadoAlumnos.xlsx');
    }

    public function exportPdf()
    {
        $alumnos = Matriculas::all();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $view = view('pdf.listAlumnoPdf', compact('alumnos'))->render();
        $dompdf->loadHtml($view);
        $dompdf->render();

        return $dompdf->stream('listadoAlumnos.pdf');
    }
}
