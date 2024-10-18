<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Asegúrate de importar el modelo
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Método para cargar los productos y mostrarlos en la vista de tomar pedido
    public function tomarPedido()
    {
        // Recupera todos los productos de la base de datos
        $productos = Producto::all();

        // Retorna la vista con los productos
        return view('dashboards.mesero.tomarPedido', compact('productos'));
    }
}

