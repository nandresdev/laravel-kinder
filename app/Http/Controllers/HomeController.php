<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Matriculas;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuarios = User::all();
        $alumnos = Matriculas::all();
        $cursos = Curso::all();

        $cantidadUsuarios = $usuarios->count();
        $cantidadAlumnos = $alumnos->count();
        $cantidadCursos = $cursos->count();
        return view('home', [
            "cantidadUsuarios" => $cantidadUsuarios, "cantidadAlumnos" => $cantidadAlumnos,
            "cantidadCursos" => $cantidadCursos
        ]);
    }
}
