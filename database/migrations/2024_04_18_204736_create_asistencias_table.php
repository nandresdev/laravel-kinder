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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_curso')->nullable();
            $table->foreign("id_curso")->references("id")->on("cursos")->onUpdate("cascade");
            $table->unsignedBigInteger('id_alumno')->nullable();
            $table->foreign("id_alumno")->references("id")->on("matriculas")->onUpdate("cascade");
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign("id_user")->references("id")->on("users")->onUpdate("cascade");
            $table->string('estado');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
