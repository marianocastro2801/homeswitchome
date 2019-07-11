<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidatosHotsaleSeeder extends Seeder
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
            'fecha_inicio' => '2020-03-15',
            'fecha_fin' => '2020-03-21',
            'fecha_inicio_inscripcion' => '2019-03-15',
            'fecha_inicio_subasta' => '2019-9-12',
            'fecha_fin_subasta' => '2019-9-15',
        ]);

        DB::table('subastas')->insert([
          'id' => '1',
          'monto_base' => '11000',
            'id_hospedaje' => '1',
            'fecha_inicio' => '2020-04-15',
            'fecha_fin' => '2020-04-21',
            'fecha_inicio_inscripcion' => '2019-04-15',
            'fecha_inicio_subasta' => '2019-10-12',
            'fecha_fin_subasta' => '2019-10-15',
        ]);

    }

}
