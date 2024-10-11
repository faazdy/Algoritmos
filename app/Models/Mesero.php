<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesero extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
    ];
    public $timestamps = true;
}
