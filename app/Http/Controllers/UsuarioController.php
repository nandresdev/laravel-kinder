<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view();
    }


    public function store(Request $request)
    {
    }


    public function show(string $id)
    {
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
    }
}
