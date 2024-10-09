<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $fillable = [
        'cantidad',
        'idPedido',
        'idProducto',
    ];
    public $timestamps = true;
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}
