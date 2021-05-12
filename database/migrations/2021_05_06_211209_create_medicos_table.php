<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string("ci")->unique();
            $table->string("apellidos");
            $table->string("nombres");
            $table->date("f_nac");
            $table->string("cel")->unique();
            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');

            $table->unsignedBigInteger('salario_id');
            $table->foreign('salario_id')->references('id')->on('salarios');
            $table->unsignedBigInteger('turnos_id');
            $table->foreign('turnos_id')->references('id')->on('turnos');
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
        Schema::dropIfExists('medicos');
    }
}
