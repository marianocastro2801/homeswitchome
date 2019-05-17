<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospedajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospedajes')->insert([
        	'id' => '1',
        	'tipo_hospedaje' => 'Hotel',
            'cantidad_maxima_personas' => '6',
            'titulo' => 'Hotel Posada del Sol',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor boutique hotel de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-6-04',
            'fecha_fin' => '2019-12-04',
            'imagen' => '',
            'id_localidad' => '1900',
        ]);
       /*DB::table('hospedajes')->insert([
            'id' => '2',
            'tipo_hospedaje' => 'Departamento',
            'cantidad_maxima_personas' => '4',
            'titulo' => 'Departamento La plata',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor departamento de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-5-04',
            'fecha_fin' => '2019-10-04',
            'imagen' => '',
            'id_localidad' => '1900',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '3',
            'tipo_hospedaje' => 'Cabaña',
            'cantidad_maxima_personas' => '4',
            'titulo' => 'Cabañas del Sur',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor complejo de cabañas de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-5-17',
            'fecha_fin' => '2020-1-01',
            'imagen' => '',
            'id_localidad' => '1878',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '4',
            'tipo_hospedaje' => 'Cabaña',
            'cantidad_maxima_personas' => '6',
            'titulo' => 'Cabañas el Paraiso',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor complejo de cabañas de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-6-20',
            'fecha_fin' => '2019-12-30',
            'imagen' => '',
            'id_localidad' => '1878',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '5',
            'tipo_hospedaje' => 'Cabaña',
            'cantidad_maxima_personas' => '2',
            'titulo' => 'Cabañas Deco',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor complejo de cabañas de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-9-04',
            'fecha_fin' => '2019-5-04',
            'imagen' => '',
            'id_localidad' => '1902',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '6',
            'tipo_hospedaje' => 'Hotel',
            'cantidad_maxima_personas' => '2',
            'titulo' => 'Hotel Futaleufu',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor boutique hotel de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-6-04',
            'fecha_fin' => '2020-6-04',
            'imagen' => '',
            'id_localidad' => '1902',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '7',
            'tipo_hospedaje' => 'Hotel',
            'cantidad_maxima_personas' => '4',
            'titulo' => 'Hotel el Soñador',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor boutique hotel de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-6-04',
            'fecha_fin' => '2019-7-04',
            'imagen' => '1900',
            'id_localidad' => '',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '8',
            'tipo_hospedaje' => 'Departamento',
            'cantidad_maxima_personas' => '4',
            'titulo' => 'Departamentos las Golondrinas',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor departamento de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-6-14',
            'fecha_fin' => '2019-10-14',
            'imagen' => '',
            'id_localidad' => '1880',
        ]);
        DB::table('hospedajes')->insert([
            'id' => '9',
            'tipo_hospedaje' => 'Departamento',
            'cantidad_maxima_personas' => '6',
            'titulo' => 'Departamento Nahuel Huapi',
            'descripcion' => 'Los huespedes que buscan exclusividad pueden sumergirse en el ambiente discreto y distinguido del mejor departamento de lujo en el centro de la ciudad,que cuenta con 12 espectaculares habitaciones y suites de ensueño.',
            'fecha_inicio' => '2019-6-04',
            'fecha_fin' => '2019-12-04',
            'imagen' => '',
            'id_localidad' => '1880',
        ]);*/
    }
}
	