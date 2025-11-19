<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->string('nacionalidad', 100);
            $table->string('tipo_documento', 50);
            $table->string('numero_documento', 50);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 50);
            $table->string('direccion', 255);
            $table->string('ciudad', 100);
            $table->string('pais', 100);
            $table->text('descripcion');
            $table->string('foto_perfil', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
