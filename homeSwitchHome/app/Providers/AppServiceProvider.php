<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('date_overlap', function($attribute, $value, $parameters) {

            $fechaInicio = Carbon::parse($value);
            $fechaFin = Carbon::parse($parameters[1]);
            $fechaFinSubasta = Carbon::parse($parameters[0]);
            $fechaInicioSubasta = Carbon::parse($parameters[2]);

            if (($fechaInicio->gt($fechaFinSubasta)) || $fechaFin->lt($fechaInicioSubasta))
                return true;
            return false;    
        });
    }
}
