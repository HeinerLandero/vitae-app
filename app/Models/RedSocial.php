<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    protected $table = 'redes_sociales';

    protected $fillable = [
        'usuario_id',
        'plataforma',
        'url',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
