<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'usuario_id',
        'accion',
        'descripcion',
        'ip',
        'user_agent',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
