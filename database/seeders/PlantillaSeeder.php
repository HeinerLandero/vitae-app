<?php

namespace Database\Seeders;

use App\Models\Plantilla;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plantilla::create([
            'nombre' => 'Plantilla Clásica',
            'descripcion' => 'Una plantilla profesional y elegante.',
            'preview_url' => '/images/plantilla1.png',
        ]);

        Plantilla::create([
            'nombre' => 'Plantilla Moderna',
            'descripcion' => 'Diseño moderno con colores vibrantes.',
            'preview_url' => '/images/plantilla2.png',
        ]);
    }
}
