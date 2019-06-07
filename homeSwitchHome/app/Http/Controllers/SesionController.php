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
        if(empty($usuario))
            return redirect('/sesion');
        else{
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

    public function obtenerListas(){

        $hoy = Carbon::today()->format('Y-m-d');
        $fechaInscripcion = Carbon::today()->format('Y-m-d');

        $data['subastas'] = DB::table('subastas')
                            ->whereNull('ganador')
                            ->whereDate('fecha_inicio_inscripcion', '<=' , $hoy)
                            ->orderBy('created_at', 'desc')
                            ->get();
        

        return $data;
    }

    public function listarInicio(){

        // $subasta1= DB::table('subastas')->where('id', 1)->first();
        // $hospedaje1 = DB::table('hospedajes')->where('id', $subasta1->id_hospedaje)->first();
        // $subasta2 = DB::table('subastas')->where('id', 2)->first();
        // $hospedaje2 = DB::table('hospedajes')->where('id', $subasta2->id_hospedaje)->first();
        

        // $data['tituloHospedaje1'] = $hospedaje1->titulo;    
        // $data['nombreImagen1'] = $hospedaje1->imagen;   
        // $data['idSubasta1'] = $subasta1->id;
        // $data['montoBase1'] = $subasta1->monto_base;
        // $data['fechaInicio1'] = $subasta1->fecha_inicio;

        // $data['tituloHospedaje2'] = $hospedaje2->titulo;  
        // $data['nombreImagen2'] = $hospedaje2->imagen;   
        // $data['idSubasta2'] = $subasta2->id;
        // $data['montoBase2'] = $subasta2->monto_base;
        // $data['fechaInicio2'] = $subasta2->fecha_inicio;

        // return view('welcome', $data);

        $data = $this->obtenerListas();

        return view('welcome', $data);


    } 
}
