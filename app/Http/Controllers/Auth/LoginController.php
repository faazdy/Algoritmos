<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Asegúrate de importar la clase Request

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Redirección por defecto

    /**
     * Handle a successful login attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Redirigir según el rol del usuario
        if ($user->rol == 'mesero') {
            return redirect()->route('../../../public/Dashboards/mesero/index.html'); // Ruta para el dashboard del mesero
        } elseif ($user->rol == 'cajero') {
            return redirect()->route('../../../public/Dashboards/cajero/index.html'); // Ruta para el dashboard del cajero
        } elseif ($user->rol == 'admin') {
            return redirect()->route('../../../public/Dashboards/administrador/index.html'); // Ruta para el dashboard del admin
        }

        // Redirección por defecto si no coincide con ningún rol
        return redirect()->intended($this->redirectTo);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware para redirigir a los usuarios autenticados al logout
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
