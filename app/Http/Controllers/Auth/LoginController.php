<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function login(Request $request)
    {
        // Validar las credenciales
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Obtener el usuario por su email
        $usuario = Usuario::where('email', $request->email)->first();

        // Verifica que el usuario exista
        if (!$usuario) {
            return back()->withErrors(['email' => 'El email no se encuentra en el sistema']);
        }

        // Verificar si la contraseña es correcta
        if (!Hash::check($request->password, $usuario->pass)) { // Cambié a 'pass' para reflejar tu campo en la base de datos
            return back()->withErrors(['password' => 'La contraseña es incorrecta']);
        }

        // Autenticar al usuario manualmente
        Auth::login($usuario);

        // Redirigir según el rol del usuario
        return $this->authenticated($request, $usuario);
    }

    // Método para redirigir después de autenticarse
    protected function authenticated(Request $request, $user)
    {
        if ($user->idMesero) {
            return redirect()->route('mesero.dashboard'); // Cambia por la vista deseada
        } elseif ($user->idCajero) {
            return redirect()->route('cajero.dashboard'); // Cambia por la vista deseada
        } elseif ($user->idAdmin) {
            return redirect()->route('admin.dashboard'); // Cambia por la vista deseada
        }

        // Redirige al dashboard general después del inicio de sesión
        return redirect()->route('dashboard'); // Cambia 'dashboard' por el nombre de la ruta de tu vista
    }

    // Método para cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
