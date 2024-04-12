<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('id_apoderado');
            $table->unsignedBigInteger('id_curso')->nullable();
            $table->string('matricula');
            $table->foreign("id_apoderado")->references("id")->on("apoderados")->onUpdate("cascade");
            $table->foreign("id_curso")->references("id")->on("cursos")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
