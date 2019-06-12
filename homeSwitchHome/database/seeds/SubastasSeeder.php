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
            'fecha_inicio' => '2020-06-15',
            'fecha_fin' => '2020-06-22',
            'fecha_inicio_inscripcion' => '2019-06-15',
            'fecha_inicio_subasta' => '2019-12-12',
            'fecha_fin_subasta' => '2019-12-15',
        ]);

        //Subasta con fecha de creación un dia antes de la demo para mostrar que no se puede cerrar
        DB::table('subastas')->insert([
            'id' => '2',
            'monto_base' => '15000',
            'id_hospedaje' => '2',
            'fecha_inicio' => '2020-05-18',
            'fecha_fin' => '2020-05-25',
            'fecha_inicio_inscripcion' => '2019-05-18',
            'fecha_inicio_subasta' => '2019-11-15',
            'fecha_fin_subasta' => '2019-11-18',
        ]);

        //Subasta que para hacer espacio
        DB::table('subastas')->insert([
            'id' => '3',
            'monto_base' => '25000',
            'id_hospedaje' => '3',
            'fecha_inicio' => '2020-08-10',
            'fecha_fin' => '2020-08-17',
            'fecha_inicio_inscripcion' => '2019-08-10',
            'fecha_inicio_subasta' => '2019-02-07',
            'fecha_fin_subasta' => '2019-02-10',
        ]);

    }
}