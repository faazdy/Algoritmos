<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'monto',
        'fechaPago',
        'metodoPago',
        'idPedido',
        'idCajero',
    ];
    public $timestamps = true;
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }

    public function cajero()
    {
        return $this->belongsTo(Cajero::class, 'idCajero');
    }
    
}
