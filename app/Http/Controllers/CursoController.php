<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\AddCursoRequest;

class CursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    }

    public function update(Request $request, string $id)
    {
    }


    public function destroy(string $id)
    {
    }
}
