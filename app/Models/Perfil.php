<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $fillable = [
        'usuario_id',
        'cargo',
        'nacionalidad',
        'tipo_documento',
        'numero_documento',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'ciudad',
        'pais',
        'descripcion',
        'foto_perfil'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
