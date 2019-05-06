<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('puja')->nullable();
            $table->integer('id_subasta')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();

            $table->foreign('id_subasta')
                      ->references('id')->on('subastas')
                      ->onDelete('cascade');
            $table->foreign('id_usuario')
                      ->references('id')->on('usuarios')
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
        Schema::dropIfExists('participas');
    }
}
