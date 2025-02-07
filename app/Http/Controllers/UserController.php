<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\CentroCostoIntraprom;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->paginate(15);
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        return view('usuario.create', compact('roles', 'centros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'apaterno' => 'required',
            'email' => 'required',
            'usuario' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Este campo es obligatorio',
            'apaterno.required' => 'Este campo es obligatorio',
            'email.required' => 'Este campo es obligatorio',
            'usuario.required' => 'Este campo es obligatorio',
            'usuario.unique' => 'Este usuario ya existe en el sistema',
            'password.required' => 'Este campo es obligatorio',
            'password.min' => 'La contraseña debe contener por lomenos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coincide',
        ]);

        $usuario = User::create([
            'centro_costos_id' => $request->centro_costos_id,
            'name' => $request->name,
            'apaterno' => $request->apaterno,
            'amaterno' => $request->amaterno,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'password' => bcrypt($request->password),
        ]);

        $usuario->assignRole($request->rol);
        return redirect()->route('user.index')->with('message', 'El usuario ha sido agregado.');
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::orderBy('name')->get();
        $centros = CentroCostoIntraprom::orderBy('CC')->get();
        return view('usuario.edit', compact('usuario', 'roles', 'centros'));
    }

    public function update(Request $request, $id)
    {
        $passwordRules = [];
        if ($request->password) {
            $passwordRules = [
                'password' => 'required|min:8|confirmed',
            ];
        }
        $request->validate([
            'name' => 'required',
            'apaterno' => 'required',
            'email' => 'required',
        ] + $passwordRules, [
            'name.required' => 'Este campo es obligatorio',
            'apaterno.required' => 'Este campo es obligatorio',
            'email.required' => 'Este campo es obligatorio',
            'usuario.required' => 'Este campo es obligatorio',
            'usuario.unique' => 'Este usuario ya existe en el sistema',
            'password.required' => 'Este campo es obligatorio',
            'password.min' => 'La contraseña debe contener por lomenos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coincide',
        ]);
        $usuario = User::find($id);
        $usuario->update($request->except('password'));
        if ($request->password) {
            $usuario->password = bcrypt($request->password);
            $usuario->save();
        }
        return redirect()->route('user.index')->with('message', 'El usuario ha sido actualizado.');
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario->delete())
            return redirect()->route('user.index')->with('message', 'El usuario ha sido eliminado.');
    }
}
