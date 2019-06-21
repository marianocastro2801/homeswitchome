<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubastasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Lista de subastas para poder mostrar

        //Subasta para inscribirse en BERA
        DB::table('subastas')->insert([
        	'id' => '1',
        	'monto_base' => '14000',
            'id_hospedaje' => '1',
            'fecha_inicio' => '2020-06-15',
            'fecha_fin' => '2020-06-22',
            'fecha_inicio_inscripcion' => '2019-06-15',
            'fecha_inicio_subasta' => '2019-12-12',
            'fecha_fin_subasta' => '2019-12-15',
        ]);

        //Para mostrar que al cerrar la subasta igual no se puede modificar en LA PLATA
        DB::table('subastas')->insert([
            'id' => '2',
            'monto_base' => '15000',
            'id_hospedaje' => '2',
            'fecha_inicio' => '2019-12-16',
            'fecha_fin' => '2019-12-22',
            'fecha_inicio_inscripcion' => '2018-12-16',
            'fecha_inicio_subasta' => '2019-06-13',
            'fecha_fin_subasta' => '2019-06-16',
        ]);


        //La subasta 3 y 4 son para mostrar que no puede ganar en la misma semana EN LA PLATA
        DB::table('subastas')->insert([
            'id' => '3',
            'monto_base' => '12000',
            'id_hospedaje' => '2',
            'fecha_inicio' => '2019-12-09',
            'fecha_fin' => '2019-12-15',
            'fecha_inicio_inscripcion' => '2018-12-09',
            'fecha_inicio_subasta' => '2019-06-06',
            'fecha_fin_subasta' => '2019-06-09',
        ]);

        //EN BERA
        DB::table('subastas')->insert([
            'id' => '4',
            'monto_base' => '20000',
            'id_hospedaje' => '1',
            'fecha_inicio' => '2019-12-09',
            'fecha_fin' => '2019-12-15',
            'fecha_inicio_inscripcion' => '2018-12-09',
            'fecha_inicio_subasta' => '2019-06-06',
            'fecha_fin_subasta' => '2019-06-09',
        ]);


        //Para mostrar que aunque haya pujador puede no haber ganador EN QUILMES
        DB::table('subastas')->insert([
            'id' => '5',
            'monto_base' => '6000',
            'id_hospedaje' => '3',
            'fecha_inicio' => '2019-12-09',
            'fecha_fin' => '2019-12-15',
            'fecha_inicio_inscripcion' => '2018-12-09',
            'fecha_inicio_subasta' => '2019-06-06',
            'fecha_fin_subasta' => '2019-06-09',
        ]);    


        //Para poder pujar y mostrar que se muestra en el perfil EN QUILMES
        DB::table('subastas')->insert([
            'id' => '6',
            'monto_base' => '5000',
            'id_hospedaje' => '3',
            'fecha_inicio' => '2019-12-23',
            'fecha_fin' => '2019-12-29',
            'fecha_inicio_inscripcion' => '2018-12-23',
            'fecha_inicio_subasta' => '2019-06-20',
            'fecha_fin_subasta' => '2019-06-23',
        ]);    


        //Para poder mostrar que se puede pujar el monto base EN LA PLATA
        DB::table('subastas')->insert([
            'id' => '7',
            'monto_base' => '24000',
            'id_hospedaje' => '2',
            'fecha_inicio' => '2019-12-23',
            'fecha_fin' => '2019-12-29',
            'fecha_inicio_inscripcion' => '2018-12-23',
            'fecha_inicio_subasta' => '2019-06-20',
            'fecha_fin_subasta' => '2019-06-23',
        ]);

    }
}