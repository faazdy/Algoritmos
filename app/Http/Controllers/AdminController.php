<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Usuario;

class AdminController extends Controller
{
    public function showRegistrationForm(){
        return view('create.admin');
    }

    public function register(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el Admin
        $admin = Admin::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);
        // Crear el usuario asociado
        Usuario::create([
            'email' => $request->email,
            'pass' => $request->password, // La contraseña se cifrará automáticamente
            'idAdmin' => $admin->id,
            'rol' => 'admin', // Establece el rol por defecto aquí
        ]);

        return redirect()->route('login.form')->with('success', 'Administrador registrado con éxito.');
    }
}
