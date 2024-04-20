<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Curso;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\CursosExport;
use App\Http\Requests\AddCursoRequest;
use App\Http\Requests\EditCursoRequest;

class CursoController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
    }
    public function index()
    {
        $cursos = Curso::all();
        return view("web.curso.listCurso", [
            "cursos" => $cursos
        ]);
    }

    public function create()
    {
        return view('web.curso.addCurso');
    }

    public function store(AddCursoRequest $request)
    {
        $curso = new Curso();
        $curso->nombre = $request->input('nombre');
        $curso->jornada = $request->input('jornada');
        $curso->categoria = $request->input('categoria');
        $curso->save();

        return response()->json($curso);
    }

    public function show($id)
    {
        $curso = Curso::findOrFail($id);

        return view('web.curso.showCurso', [
            "curso" => $curso
        ]);
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);

        return view('web.curso.editCurso', [
            "curso" => $curso
        ]);
    }

    public function update(EditCursoRequest $request, $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->nombre = $request->input('nombre');
        $curso->jornada = $request->input('jornada');
        $curso->categoria = $request->input('categoria');
        $curso->save();

        return response()->json($curso);
    }


    public function destroy(Curso $curso)
    {
        $curso->delete();
        return response()->json(['message' => 'Curso eliminado correctamente'], 200);
    }

    public function exportExcel()
    {
        return $this->excel->download(new CursosExport, 'listadoCursos.xlsx');
    }

    public function exportPdf()
    {
        $cursos = Curso::all();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $view = view('pdf.listCursosPdf', compact('cursos'))->render();
        $dompdf->loadHtml($view);
        $dompdf->render();

        return $dompdf->stream('listadoCursos.pdf');
    }
}
