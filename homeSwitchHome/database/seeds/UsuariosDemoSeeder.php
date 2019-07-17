<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin de la demostracion

    	DB::table('usuarios')->insert([
    		'id'=> 	1,
    		'nombre'=> 'Andrea',
    		'apellido'=> 'Perez',
    		'email'=> 'andreaperez@gmail.com',
    		'es_premium'=> 0,
    		'numero_tarjeta'=> '2345678913456743',
            'mes_vencimiento'=> '05',
            'anio_vencimiento'=> '20',
            'codigo_seguridad'=> '345',
            'contrasenia' => 'andreaperez',
    		'fecha_nacimiento'=> '1990-06-04',
        'created_at' => '1990-06-04'
    	]);

        //Usuarios del sistema


        //Usuario sin credito en la tarjeta
    	DB::table('usuarios')->insert([
    		'id'=> 	2,
    		'nombre'=> 'Carlos',
    		'apellido'=> 'Rivero',
    		'email'=> 'supernovas1470@hotmail.com',
    		'es_premium'=> 0,
    		'numero_tarjeta'=> '2987654321874325',
            'mes_vencimiento'=> '05',
            'anio_vencimiento'=> '23',
            'codigo_seguridad'=> '778',
            'contrasenia' => 'carlosrivero',
    		'fecha_nacimiento'=> '1996-06-15',
        'created_at' => '1990-06-04'
    	]);


        //Usuario con créditos y credito en la tarjeta, posee un único crédito para poder
        //mostrar que no puede pujar una vez se cierre la subasta 1
    	DB::table('usuarios')->insert([
    		'id'=> 	3,
    		'nombre'=> 'Leonel',
    		'apellido'=> 'Mandarino',
    		'email'=> 'leonelmandarino@gmail.com',
    		'es_premium'=> 1,
    		'numero_tarjeta'=> '2345390313456743',
            'mes_vencimiento'=> '01',
            'anio_vencimiento'=> '22',
            'codigo_seguridad'=> '543',
            'contrasenia' => 'leonelmandarino',
    		'fecha_nacimiento'=> '1996-05-29',
            'creditos' => 1,
            'created_at' => '1990-06-04'
    	]);

        //Usuario para mostrar que no puede reservas dos hospedajes en la misma semana
    	DB::table('usuarios')->insert([
    		'id'=> 	4,
    		'nombre'=> 'Marcos',
    		'apellido'=> 'Pereyra',
    		'email'=> 'marcospereyra@yahoo.com.ar',
    		'es_premium'=> 0,
    		'numero_tarjeta'=> '1628826890234123',
            'mes_vencimiento'=> '04',
            'anio_vencimiento'=> '21',
            'codigo_seguridad'=> '365',
            'contrasenia' => 'marcospereyra',
    		'fecha_nacimiento'=> '1996-10-04',
            'creditos' => 2,
            'created_at' => '1990-06-04'
    	]);
    }
}
