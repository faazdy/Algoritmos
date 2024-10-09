<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SedeMesero extends Model
{
    protected $fillable = [
        'sede',
        'mesero',
    ];
    public $timestamps = true;
    
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede');
    }

    public function mesero()
    {
        return $this->belongsTo(Mesero::class, 'mesero');
    }
}
