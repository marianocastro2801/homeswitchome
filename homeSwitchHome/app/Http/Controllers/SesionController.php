<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Usuario;

class SesionController extends Controller
{
    public function iniciar(Request $request){
        $usuario = DB::table('usuarios')
                    ->where('nombre', $request->input('nombreUsuario'))
                    ->first();

        session(['idUsuario' => $usuario->id, 
        	'nombreUsuario' => $usuario->nombre, 
        	'apellidoUsuario' => $usuario->apellido, 
        	'email' => $usuario->email, 
        	'esPremium' => $usuario->es_premium, 
        	'numeroTarjeta' => $usuario->numero_tarjeta, 
            'creditos' => $usuario->creditos,
        	'fechaNacimiento' => $usuario->fecha_nacimiento]);


        return redirect('/');            
    } 
}
