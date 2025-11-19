<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    protected $table = 'experiencias';

    protected $fillable = [
        'usuario_id',
        'empresa',
        'cargo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'es_actual',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
