<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InscripcionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Para mostrar por si no dejan cambiar la fecha que el usuario Carlos recibe notificacion de la subasta
        DB::table('inscripcions')->insert([
            'id' => '1',
            'id_usuario' => '2',
            'id_subasta' => '5'
        ]);

    }
}