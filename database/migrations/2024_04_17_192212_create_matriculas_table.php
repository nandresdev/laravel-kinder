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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_alumno');
            $table->string('nombre_apoderado_principal');
            $table->string('telefono_principal');
            $table->string('telefono_emergencia_principal')->nullable();
            $table->string('nombre_apoderado_secundario');
            $table->string('telefono_secundario');
            $table->string('telefono_emergencia_secundario')->nullable();
            $table->unsignedBigInteger('id_curso')->nullable();
            $table->foreign("id_curso")->references("id")->on("cursos")->onUpdate("cascade");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
