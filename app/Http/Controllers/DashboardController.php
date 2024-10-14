<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mesero()
    {
        return view('dashboards.mesero'); // Asegúrate de que esta vista exista
    }

    public function cajero()
    {
        return view('dashboards.cajero'); // Asegúrate de que esta vista exista
    }

    public function admin()
    {
        return view('dashboards.admin'); // Asegúrate de que esta vista exista
    }
}
