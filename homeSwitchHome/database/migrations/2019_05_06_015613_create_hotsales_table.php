<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotsales', function (Blueprint $table) {
            $table->increments('id');
            $table->float('precio_base')->nullable();
            $table->boolean('candidato')->default($value = true);
            $table->integer('id_subasta')->unsigned();
            $table->timestamps();

            $table->foreign('id_subasta')
                      ->references('id')->on('subastas')
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
        Schema::dropIfExists('hotsales');
    }
}
