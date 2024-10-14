<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash; // Importa la clase Hash

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'email',
        'pass',
    ];

    // Asegúrate de que la contraseña se almacene con el nombre 'pass'
    protected $hidden = [
        'pass',
    ];

    public function getAuthPassword()
    {
        return $this->pass; // Esto asegura que Laravel use el campo 'pass' para la contraseña
    }

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

    protected $casts = [ // Cambiado a propiedad pública
        'email_verified_at' => 'datetime',
    ];

    // Mutador para encriptar la contraseña
    public function setPassAttribute($value)
    {
        $this->attributes['pass'] = Hash::make($value);
    }
}
