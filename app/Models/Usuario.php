<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'slug',
        'perfil_estado',
        'plantilla_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function plantilla()
    {
        return $this->belongsTo(Plantilla::class);
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class);
    }

    public function educaciones()
    {
        return $this->hasMany(Educacion::class);
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class);
    }

    public function habilidades()
    {
        return $this->hasMany(Habilidad::class);
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function idiomas()
    {
        return $this->hasMany(Idioma::class);
    }

    public function redesSociales()
    {
        return $this->hasMany(RedSocial::class);
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    /**
     * Genera el QR code on-demand basado en la URL del CV público
     */
    public function getQrCodeAttribute(): string
    {
        $url = url('/cv/' . $this->slug);
        $qrCode = QrCode::format('svg')->size(200)->generate($url);
        return 'data:image/svg+xml;base64,' . base64_encode($qrCode);
    }

}
