<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'pass',
        "rol",
        'idMesero',
        'idCajero',
        'idAdmin',
    ];

    public function mesero()
    {
        return $this->belongsTo(Mesero::class, 'idMesero');
    }

    public function cajero()
    {
        return $this->belongsTo(Cajero::class, 'idCajero');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'idAdmin');
    }
}
