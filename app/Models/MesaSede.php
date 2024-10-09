<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesaSede extends Model
{
    protected $fillable = [
        'idMesa',
        'idSede',
    ];
    public $timestamps = true;
    
    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'idMesa');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'idSede');
    }
}
