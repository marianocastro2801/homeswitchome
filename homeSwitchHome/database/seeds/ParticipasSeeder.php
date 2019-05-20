<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participas')->insert([
            'id' => '1',
            'puja' => '16000'
            'id_usuario' => '3',
            'id_subasta' => '1'
        ]);

    }
}