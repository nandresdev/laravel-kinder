<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddApoderadoRequest;
use App\Http\Requests\EditApoderadoRequest;
use App\Models\Apoderado;
use Illuminate\Http\Request;

class ApoderadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $apoderados = Apoderado::all();
        return view("web.apoderado.listApoderado", [
            "apoderados" => $apoderados
        ]);
    }

    public function create()
    {
        return view("web.apoderado.addApoderado");
    }

    public function store(AddApoderadoRequest $request)
    {
        $apoderado = new Apoderado();
        $apoderado->rut = $request->input('rut');
        $apoderado->nombre = $request->input('nombre');
        $apoderado->telefono = $request->input('telefono');
        $apoderado->telefono_emergencia = $request->input('telefono_emergencia');
        $apoderado->save();

        return response()->json($apoderado);
    }

    public function edit($id)
    {
        $apoderado = Apoderado::findOrFail($id);

        return view('web.apoderado.editApoderado', [
            "apoderado" => $apoderado
        ]);
    }

    public function update(EditApoderadoRequest $request, $id)
    {
        $apoderado = Apoderado::findOrFail($id);
        $apoderado->rut = $request->input('rut');
        $apoderado->nombre = $request->input('nombre');
        $apoderado->telefono = $request->input('telefono');
        $apoderado->telefono_emergencia = $request->input('telefono_emergencia');
        $apoderado->save();

        return response()->json($apoderado);
    }

    public function destroy(Apoderado $apoderado)
    {
        $apoderado->delete();
        return response()->json(['message' => 'Apoderado eliminado correctamente'], 200);
    }
}
