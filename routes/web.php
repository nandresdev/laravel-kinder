<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ApoderadoController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
});

Route::group(['prefix' => 'apoderado', 'middleware' => 'auth'], function () {
    Route::get('/', [ApoderadoController::class, "index"])->name("apoderado.index");
    Route::get('/crear', [ApoderadoController::class, "create"])->name("apoderado.create");
    Route::post('/', [ApoderadoController::class, "store"])->name("apoderado.store");
    Route::get('/editar/{apoderado}', [ApoderadoController::class, "edit"])->name("apoderado.edit");
    Route::put('/{apoderado}', [ApoderadoController::class, "update"])->name("apoderado.update");
    Route::delete('/{apoderado}', [ApoderadoController::class, "destroy"])->name("apoderado.destroy");
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


Route::group(['prefix' => 'alumno', 'middleware' => 'auth'], function () {
    Route::get('/', [AlumnoController::class, "index"])->name("curso.index");

});
