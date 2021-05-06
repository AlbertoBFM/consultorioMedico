<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJefesmedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jefesmedicos', function (Blueprint $table) {
            $table->id();
            $table->string("ci")->unique();
            $table->string("apellidos");
            $table->string("nombres");
            $table->date("f_nac");
            $table->string("cel")->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('jefesmedicos');
    }
}
