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
    	DB::table('usuarios')->insert([
    		'id'=> 	//completar
    		'nombre'=> //completar
    		'apellido'=> //completar
    		'email'=> //completar
    		'es_premium'=> //completar
    		'numero_tarjeta'=> //completar
    		'fecha_nacimiento'=> //completar
    	]);
    	DB::table('usuarios')->insert([
    		'id'=> 	//completar
    		'nombre'=> //completar
    		'apellido'=> //completar
    		'email'=> //completar
    		'es_premium'=> //completar
    		'numero_tarjeta'=> //completar
    		'fecha_nacimiento'=> //completar
    	]);
    	DB::table('usuarios')->insert([
    		'id'=> 	//completar
    		'nombre'=> //completar
    		'apellido'=> //completar
    		'email'=> //completar
    		'es_premium'=> //completar
    		'numero_tarjeta'=> //completar
    		'fecha_nacimiento'=> //completar
    	]);
    	DB::table('usuarios')->insert([
    		'id'=> 	//completar
    		'nombre'=> //completar
    		'apellido'=> //completar
    		'email'=> //completar
    		'es_premium'=> //completar
    		'numero_tarjeta'=> //completar
    		'fecha_nacimiento'=> //completar
    	]);
    }
}