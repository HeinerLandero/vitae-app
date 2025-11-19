<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'tipo',
        'url',
        'descripcion',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
