<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'publicaciones';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'url',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
