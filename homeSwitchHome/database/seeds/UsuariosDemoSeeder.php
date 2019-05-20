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
    		'numero_tarjeta'=> '000000',
    		'fecha_nacimiento'=> '1990-06-04'
    	]);

        //Usuarios del sistema


        //Usuario sin credito en la tarjeta
    	DB::table('usuarios')->insert([
    		'id'=> 	2,
    		'nombre'=> 'Carlos',
    		'apellido'=> 'Rivero',
    		'email'=> 'supernovar1470@hotmail.com',
    		'es_premium'=> 0,
    		'numero_tarjeta'=> '12345',
    		'fecha_nacimiento'=> '1996-06-15'
    	]);


        //Usuario con créditos y credito en la tarjeta, posee un único crédito para poder
        //mostrar que no puede pujar una vez se cierre la subasta 1
    	DB::table('usuarios')->insert([
    		'id'=> 	3,
    		'nombre'=> 'Leonel',
    		'apellido'=> 'Mandarino',
    		'email'=> 'leonelmandarino@gmail.com',
    		'es_premium'=> 0,
    		'numero_tarjeta'=> '5677654',
    		'fecha_nacimiento'=> '2093-05-29',
            'creditos' => 1
    	]);

        //Usuario sin creditos
    	DB::table('usuarios')->insert([
    		'id'=> 	4,
    		'nombre'=> 'Marcos',
    		'apellido'=> 'Pereyra',
    		'email'=> 'marcospereyra@yahoo.com.ar',
    		'es_premium'=> 0,
    		'numero_tarjeta'=> '1628826',
    		'fecha_nacimiento'=> '2090-10-04',
            'creditos' => 0
    	]);
    }
}