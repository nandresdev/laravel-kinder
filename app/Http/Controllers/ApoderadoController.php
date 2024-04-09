<?php

namespace App\Http\Controllers;

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
    }

    public function store(Request $request)
    {
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
