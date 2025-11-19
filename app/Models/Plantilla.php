<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $table = 'plantillas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'preview_url',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
