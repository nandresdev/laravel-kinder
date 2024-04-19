<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ApoderadoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::group(['prefix' => 'usuario', 'middleware' => 'auth'], function () {
    Route::get('/', [UsuarioController::class, "index"])->name("usuario.index");
    Route::get('/crear', [UsuarioController::class, "create"])->name("usuario.create");
    Route::post('/', [UsuarioController::class, "store"])->name("usuario.store");
    Route::get('/editar/{usuario}', [UsuarioController::class, "edit"])->name("usuario.edit");
    Route::put('/{usuario}', [UsuarioController::class, "update"])->name("usuario.update");
    Route::delete('/{usuario}', [UsuarioController::class, "destroy"])->name("usuario.destroy");
    Route::get('/exportar/excel', [UsuarioController::class, 'exportExcel'])->name('usuario.excel');
    Route::get('/exportar/pdf', [UsuarioController::class, 'exportPdf'])->name('usuario.pdf');
});

Route::group(['prefix' => 'cursos', 'middleware' => 'auth'], function () {
    Route::get('/', [CursoController::class, "index"])->name("curso.index");
    Route::get('/crear', [CursoController::class, "create"])->name("curso.create");
    Route::post('/', [CursoController::class, "store"])->name("curso.store");
    Route::get('/ver/{curso}', [CursoController::class, "show"])->name("curso.show");
    Route::get('/editar/{curso}', [CursoController::class, "edit"])->name("curso.edit");
    Route::put('/{curso}', [CursoController::class, "update"])->name("curso.update");
    Route::delete('/{curso}', [CursoController::class, "destroy"])->name("curso.destroy");
});

Route::group(['prefix' => 'matricula', 'middleware' => 'auth'], function () {
    Route::get('/crear', [MatriculaController::class, "create"])->name("matricula.create");
    Route::post('/', [MatriculaController::class, "store"])->name("matricula.store");
    Route::get('/editar/{alumno}', [MatriculaController::class, "edit"])->name("matricula.edit");
    Route::put('/{alumno}', [MatriculaController::class, "update"])->name("matricula.update");
    Route::delete('/{alumno}', [MatriculaController::class, "destroy"])->name("matricula.destroy");
    Route::get('/exportar/excel', [MatriculaController::class, 'exportExcel'])->name('matricula.excel');
});

Route::group(['prefix' => 'asistencia', 'middleware' => 'auth'], function () {
    Route::get('/', [AsistenciaController::class, "index"])->name("asistencia.index");
    Route::get('/crear', [AsistenciaController::class, "create"])->name("asistencia.create");
    Route::post('/', [AsistenciaController::class, "store"])->name("asistencia.store");
    Route::post('/obtener-alumnos', [AsistenciaController::class, "obtenerAlumnosPorCurso"])->name("asistencia.obtenerAlumnosPorCurso");
    Route::delete('/{fecha}', [AsistenciaController::class, "destroy"])->name("asistencia.destroy");
});


Route::group(['prefix' => 'alumno', 'middleware' => 'auth'], function () {
    Route::get('/', [AlumnoController::class, "index"])->name("alumno.index");
    Route::get('/ver/{alumno}', [AlumnoController::class, "show"])->name("alumno.show");
});
