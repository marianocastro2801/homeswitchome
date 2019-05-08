<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subastas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->float('monto_base', 8, 2);
            $table->float('monto_maximo', 8, 2)->nullable();
            $table->integer('ganador')->nullable();
            $table->integer('id_hospedaje')->unsigned();
            $table->timestamps();

            $table->foreign('id_hospedaje')
                      ->references('id')->on('hospedajes')
                      ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subastas');
    }
}
