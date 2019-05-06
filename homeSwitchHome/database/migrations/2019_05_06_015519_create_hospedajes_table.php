<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospedajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedajes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_hospedaje');
            $table->string('cantidad_maxima_personas'); 
            $table->string('titulo');
            $table->string('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('imagen');
            $table->integer('id_localidad')->unsigned();
            $table->timestamps();

            $table->foreign('id_localidad')
                      ->references('id')->on('localidads');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospedajes');
    }
}
