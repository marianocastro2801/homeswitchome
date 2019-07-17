<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificacionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notificacions')->insert([
          'id' => '4',
          'id_usuario' => '2',
          'mensaje' => ' Se ha cobrado el monto de registro de su tarjeta. Se comenzará a cobrar el monto mensual a partir del próximo més',
          'created_at' => '1990-06-04'
          ]);
        DB::table('notificacions')->insert([
          'id' => '5',
          'id_usuario' => '3',
          'mensaje' => ' Se ha cobrado el monto de registro de su tarjeta. Se comenzará a cobrar el monto mensual a partir del próximo més',
          'created_at' => '1990-06-04'
          ]);
        DB::table('notificacions')->insert([
          'id' => '6',
          'id_usuario' => '4',
          'mensaje' => ' Se ha cobrado el monto de registro de su tarjeta. Se comenzará a cobrar el monto mensual a partir del próximo més',
          'created_at' => '1990-06-04'
          ]);
    }
}
