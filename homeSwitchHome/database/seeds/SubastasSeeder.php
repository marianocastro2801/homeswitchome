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

        //Subasta con fecha de creación hoy para poder cerrar en la demo, mostrar que al cerrar
        //se descuenta el crédito al usuario 3 (Leonel Mandarino) y no puede puajar
        DB::table('subastas')->insert([
        	'id' => '1',
        	'monto_base' => '14000',
            'id_hospedaje' => '1',
            'fecha_inicio' => '2019-06-14',
            'fecha_fin' => '2019-06-21',
            'created_at' => '2019-05-19 00:00:00',
        ]);

        //Subasta con fecha de creación un dia antes de la demo para mostrar que no se puede cerrar
        DB::table('subastas')->insert([
            'id' => '2',
            'monto_base' => '15000',
            'id_hospedaje' => '2',
            'fecha_inicio' => '2019-05-21',
            'fecha_fin' => '2019-05-28',
            'created_at' => '2019-05-22 00:00:00',
        ]);

        //Subasta que para hacer espacio
        DB::table('subastas')->insert([
            'id' => '3',
            'monto_base' => '25000',
            'id_hospedaje' => '3',
            'fecha_inicio' => '2019-08-01',
            'fecha_fin' => '2019-08-08',
            'created_at' => '2019-05-22 00:00:00',
        ]);

    }
}