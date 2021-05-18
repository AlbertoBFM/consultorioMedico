<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->string("Anamnesis");
            $table->string("Enfermedad_Actual");
            $table->String("Examen_Fisico_General");
            $table->String("Examenes_complementarios");
            $table->String("Diagnostico");
            $table->String("Tratamiento");
            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosticos');
    }
}
