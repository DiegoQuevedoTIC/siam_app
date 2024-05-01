<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documentoclase_id');
            $table->unsignedBigInteger('documentotipo_id');
            $table->unsignedBigInteger('llave_de_consulta_id');
            $table->string('ruta_imagen'); // Campo para la ruta o nombre del archivo de la imagen
            // Otros campos de tu documento
            $table->string('llave_de_consulta_type'); // Campo para el tipo de la llave de consulta
            $table->foreign('documentoclase_id')->references('id')->on('documentoclases');
            $table->foreign('documentotipo_id')->references('id')->on('documentotipos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
