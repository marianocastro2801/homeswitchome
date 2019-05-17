<?php

    
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localidads')->insert([
        	'id' => '1900',
        	'nombre' => 'La Plata',
        ]);
       	DB::table('localidads')->insert([
        	'id' => '1878',
        	'nombre' => 'Quilmes',
        ]);
        DB::table('localidads')->insert([
        	'id' => '1876',
        	'nombre' => 'Bernal',
        ]);
        DB::table('localidads')->insert([
        	'id' => '1906',
        	'nombre' => 'Tolosa',
        ]);
        DB::table('localidads')->insert([
        	'id' => '1902',
        	'nombre' => 'City Bell',
        ]);
        DB::table('localidads')->insert([
        	'id' => '1880',
        	'nombre' => 'Berazategui',
        ]);
    }
}
	