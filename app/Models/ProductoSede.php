<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoSede extends Model
{
    protected $fillable = [
        'cantidad',
        'idProducto',
        'idSede',
    ];

    public $timestamps = true;
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'idSede');
    }
}
