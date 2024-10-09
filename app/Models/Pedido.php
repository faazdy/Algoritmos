<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'fecha',
        'estado',
        'idMesa',
        'idMesero',
        'idCajero',
    ];
    public $timestamps = true;

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'idMesa');
    }

    public function mesero()
    {
        return $this->belongsTo(Mesero::class, 'idMesero');
    }

    public function cajero()
    {
        return $this->belongsTo(Cajero::class, 'idCajero');
    }
}
