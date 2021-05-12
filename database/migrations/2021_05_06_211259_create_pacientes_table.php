<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string("ci")->unique();
            $table->string("apellidos");
            $table->string("nombres");
            $table->date("f_nac");
            $table->string("sexo");
            $table->string("cel");
            $table->unsignedBigInteger('secretaria_id');
            $table->foreign('secretaria_id')->references('id')->on('secretarias');
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
        Schema::dropIfExists('pacientes');
    }
}
