<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'url',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
