<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha_pcr');
            $table->enum('resultado_pcr',['Positivo','Negativo'])->default('Negativo');
            $table->datetime('inicio_qrtna')->nullable();
            $table->datetime('fin_qrtna')->nullable();
            $table->datetime('extension_qrtna')->nullable();
            $table->string('tto_farmacologico')->nullable();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->unsignedBigInteger('usuario_id');
             $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::dropIfExists('casos');
    }
}
