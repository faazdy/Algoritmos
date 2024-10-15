<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cajero;
use App\Models\Usuario;

class CajeroController extends Controller
{

    public function showRegistrationForm()
    {
        return view('create.cajero');
    }

    
    // Manejar el registro de cajeros
    public function register(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el cajero
        $cajero = Cajero::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        // Crear el usuario asociado
        Usuario::create([
            'email' => $request->email,
            'pass' => $request->password, // La contraseña se cifrará automáticamente
            'idCajero' => $cajero->id,
            'rol' => 'cajero', // Establece el rol por defecto aquí
        ]);

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->route('login.form')->with('success', 'Cajero registrado con éxito.');
    }
}
