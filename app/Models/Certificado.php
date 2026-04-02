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

    // Mapeo de campos del frontend al modelo
    public static function mapFrontendFields($data)
    {
        return [
            'nombre' => $data['titulo'] ?? null,
            'entidad' => $data['institucion'] ?? null,
            'fecha_expedicion' => $data['fecha_emision'] ?? null,
            'tipo' => $data['tipo'] ?? 'certificacion',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Accessors para compatibilidad con el frontend
    public function getTituloAttribute()
    {
        return $this->nombre;
    }

    public function getInstitucionAttribute()
    {
        return $this->entidad;
    }

    public function getFechaEmisionAttribute()
    {
        return $this->fecha_expedicion;
    }
}
