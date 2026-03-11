<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //agregar

class UserController extends Controller
{
    //Listado de usuarios
    public function index()
    {
        $users = User::all(); // Trae todos los usuarios
        return view('users.usuarios', compact('users'));
    }

    public function inactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario inactivado correctamente.');
    }

    public function create()
    {
        $users = User::all();
        $accion = 'crear';

        return view('users.usuarios', compact('users','accion'));
    }

    public function show($id)
    {
        $users = User::all();
        $usuario = User::findOrFail($id);
        $accion = 'ver';

        return view('users.usuarios', compact('users','usuario','accion'));
    }

    public function edit($id)
    {
        $users = User::all();
        $usuario = User::findOrFail($id);
        $accion = 'editar';

        
        return view('users.usuarios', compact('users','usuario','accion'));
    }
    //metodo para guardar usuario
    public function store(Request $request)
    {

        User::create([

        'nombres' => $request->nombres,
        'apellidos' => $request->apellidos,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'status' => 1

        ]);

        return redirect()->route('users.index');

    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'nombres'=>$request->nombres,
            'apellidos'=>$request->apellidos,
            'email'=>$request->email
        ]);


        return redirect()->route('users.index');
    }


}



