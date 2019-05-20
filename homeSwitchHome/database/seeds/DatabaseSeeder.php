<?php

/*
    composer dump-autoload
    php artisan db:seed
*/

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LocalidadsSeeder::class);
        $this->call(HospedajesSeeder::class);
        $this->call(UsuariosDemoSeeder::class);
        $this->call(SubastasSeeder::class);
        $this->call(ParticipassSeeder::class);
    }
}
