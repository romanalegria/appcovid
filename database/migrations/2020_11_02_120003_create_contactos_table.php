<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();           
            $table->string('rut');
            $table->string('nombre');
            $table->enum('sexo',['Masculino','Femenino'])->default('Masculino');
            $table->integer('edad');
            $table->string('telefono',11)->nullable();
            $table->string('movil',11)->nullable();
            $table->string('direccion');
            $table->string('email')->unique();
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
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
        Schema::dropIfExists('contactos');
    }
}
