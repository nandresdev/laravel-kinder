<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddUsuarioRequest;
use App\Http\Requests\EditUsuarioRequest;

class UsuarioController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
    }

    public function index()
    {
        $users = User::all();
        return view("web.user.listUser", [
            "users" => $users
        ]);
    }

    public function create()
    {
        return view('web.user.addUser');
    }

    public function store(AddUsuarioRequest $request)
    {
        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->save();

        return response()->json($usuario);
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        return view('web.user.editUser', [
            "usuario" => $usuario
        ]);
    }

    public function update(EditUsuarioRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->save();

        return response()->json($usuario);
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }

    public function exportExcel()
    {
        return $this->excel->download(new UsersExport, 'listadoUsuarios.xlsx');
    }
}
