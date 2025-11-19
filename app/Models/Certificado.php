<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table = 'certificados';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'entidad',
        'fecha_expedicion',
        'url_documento',
        'tipo',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
