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

        //Subasta con fecha de creación 19 de mayo para poder cerrar en la demo, mostrar que al cerrar
        //se descuenta el crédito al usuario 3 (Leonel Mandarino) y no puede puajar
        DB::table('subastas')->insert([
        	'id' => '1',
        	'monto_base' => '14000',
            'id_hospedaje' => '1',
            'fecha_inicio' => '2020-06-14',
            'fecha_fin' => '2020-06-21',
            'fecha_inicio_inscripcion' => '2019-06-14',
            'fecha_inicio_subasta' => '2019-12-11',
            'fecha_fin_subasta' => '2019-12-14',
        ]);

        //Subasta con fecha de creación un dia antes de la demo para mostrar que no se puede cerrar
        DB::table('subastas')->insert([
            'id' => '2',
            'monto_base' => '15000',
            'id_hospedaje' => '2',
            'fecha_inicio' => '2020-05-21',
            'fecha_fin' => '2020-05-28',
            'fecha_inicio_inscripcion' => '2019-05-21',
            'fecha_inicio_subasta' => '2019-05-18',
            'fecha_fin_subasta' => '2020-05-21',
        ]);

        //Subasta que para hacer espacio
        DB::table('subastas')->insert([
            'id' => '3',
            'monto_base' => '25000',
            'id_hospedaje' => '3',
            'fecha_inicio' => '2020-08-01',
            'fecha_fin' => '2020-08-08',
            'fecha_inicio_inscripcion' => '2019-08-01',
            'fecha_inicio_subasta' => '2019-01-29',
            'fecha_fin_subasta' => '2019-02-01',
        ]);

    }
}