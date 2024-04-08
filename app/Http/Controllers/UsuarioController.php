<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddUsuarioRequest;
use App\Http\Requests\EditUsuarioRequest;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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


    public function destroy(string $id)
    {
    }
}
