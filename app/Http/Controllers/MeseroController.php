<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesero;
use App\Models\Usuario;

class MeseroController extends Controller
{
    public function showRegistrationForm(){
        return view('create.mesero');
    }

    public function register(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el mesero
        $mesero = Mesero::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);
        // Crear el usuario asociado
        Usuario::create([
            'email' => $request->email,
            'pass' => $request->password, // La contraseña se cifrará automáticamente
            'idMesero' => $mesero->id,
            'rol' => 'mesero', // Establece el rol por defecto aquí
        ]);

        return redirect()->route('login.form')->with('success', 'Mesero registrado con éxito.');
    }
    // Método para ver las mesas
    public function tusMesas()
    {
        // Obtener las mesas que están siendo atendidas
        $mesasAtendiendo = Mesa::where('estado', 'atendiendo')->get(); // Asegúrate de que tu modelo y campo existan
        return view('mesero.tusMesas', compact('mesasAtendiendo')); // Cambiado a la ruta correcta
    }

    // Método para ver el inventario
    public function verInventario()
    {
        // Obtener el inventario de productos
        $inventario = Producto::all(); // Asegúrate de que tu modelo exista
        return view('mesero.verInventario', compact('inventario')); // Cambiado a la ruta correcta
    }
}
