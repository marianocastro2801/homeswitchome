<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuario Marcos participa en 2 para mostrar que no puede ganar en la misma semana
        DB::table('participas')->insert([
            'id' => '1',
            'puja' => '13000',
            'id_usuario' => '4',
            'id_subasta' => '3'
        ]);

        DB::table('participas')->insert([
            'id' => '2',
            'puja' => '20000',
            'id_usuario' => '4',
            'id_subasta' => '4'
        ]);

        //Usuario Carlos para mostrar que auque es el máximo pujando no gana por falta de credito en la tarjeta
        DB::table('participas')->insert([
            'id' => '3',
            'puja' => '7500',
            'id_usuario' => '2',
            'id_subasta' => '5'
        ]);

        DB::table('inscripcions')->insert([
            'id' => '1',
            'id_usuario' => '2',
            'id_subasta' => '5'
        ]);

    }
}