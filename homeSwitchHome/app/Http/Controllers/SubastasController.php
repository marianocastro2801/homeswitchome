<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use App\Subasta;
use App\Participa;

class SubastasController extends Controller
{
    public function crearSubasta($idHospedaje){
        $hospedaje = DB::table('hospedajes')
                    ->where('id', $idHospedaje)
                    ->first();

        $data['titulo'] = $hospedaje->titulo;
        $data['idHospedaje'] = $hospedaje->id;
        $data['fechaInicioHospedaje'] = $hospedaje->fecha_inicio;   
        $data['fechaFinHospedaje'] = $hospedaje->fecha_fin;          

        return view('crearSubasta', $data);            
    } 

    public function validar(Request $request){
        $fechaInicio = Carbon::create($request->input('fechaInicio'));
        $fechaFin = Carbon::create($request->input('fechaInicio'))->addDays(7)->format('Y-m-d');
        $request['fechaFin'] = $fechaFin;


        $request->validate([
            'montoBase' => 'required|numeric|gt:0',
            'fechaInicio' => 'required|after_or_equal:fechaInicioHospedaje',
            'fechaFin' => 'before_or_equal:fechaFinHospedaje'],
            ['montoBase.required' => 'Por favor ingrese un monto base', 
             'montoBase.numeric' => 'Por favor ingrese un valor numérico',
             'montoBase.gt' => 'Por favor ingrese un monto mayor a 0',
             'fechaInicio.required' => 'Por favor ingrese una fecha de inicio',
             'fechaInicio.after_or_equal' => 'La fecha de inicio debe estar dentro del rango libre del Hospedaje',
             'fechaFin.before_or_equal' => 'La fecha de fin debe estar dentro del rango libre del Hospedaje'
               ]);

        $subastas = DB::table('subastas')
                    ->where('id_hospedaje', $request->input('idHospedaje'))
                    ->get();

        foreach ($subastas as $subasta) {
            $fechaInicioSubasta = $subasta->fecha_inicio;
            $fechaFinSubasta = $subasta->fecha_fin;
            $request['fechaInicioSubasta'] = $fechaInicioSubasta;
            $request['fechaFinSubasta'] = $fechaFinSubasta;

            $request->validate([
            'fechaInicio' => 'date_overlap:'.$fechaFinSubasta.','.$fechaFin.','.$fechaInicioSubasta],
            ['fechaInicio.date_overlap' => 'La fecha se superpone con otra subasta' ]); 
        }

        

    	$subasta = new Subasta;
    	$subasta->monto_base = $request->input('montoBase');
    	$subasta->fecha_inicio = $fechaInicio;
        $subasta->fecha_fin = $fechaFin;
    	$subasta->id_hospedaje = $request->input('idHospedaje');

    	$subasta->save();

    	return redirect('/');
    }

    public function detalleSubasta($idSubasta){

        $subasta = DB::table('subastas')->where('id', $idSubasta)->first();
        $hospedaje = DB::table('hospedajes')->where('id', $subasta->id_hospedaje)->first();
                
        $data['tituloHospedaje'] = $hospedaje->titulo;
        $data['maximasPersonas'] = $hospedaje->cantidad_maxima_personas; 
        $data['descripcion'] = $hospedaje->descripcion;    
        $data['nombreImagen'] = $hospedaje->imagen;   
        $data['idSubasta'] = $subasta->id;
        $data['montoBase'] = $subasta->monto_base;
        $data['fechaInicio'] = $subasta->fecha_inicio;
        $data['fechaFin'] = $subasta->fecha_fin;


        $maximaPuja = DB::table('participas')
                    ->select('id_usuario','puja')
                    ->where('id_subasta', $subasta->id)
                    ->whereRaw('puja = (SELECT MAX(puja) as puja FROM participas
                                WHERE id_subasta = ?)', [$subasta->id])
                    ->first();     
        

        if(is_null($maximaPuja)){
            $data['maximoUsuario'] = 'no hay usuario';
            $data['montoMaximo'] = 0;
        }
        else {
            $maximoUsuario = DB::table('usuarios')
                    ->where('id', $maximaPuja->id_usuario)
                    ->first();       
            $data['maximoUsuario'] = $maximoUsuario->email;
            $data['montoMaximo'] = $maximaPuja->puja;               
        }
        return view('detalleSubasta', $data);
    }

    public function pujar(Request $request){

        $subasta = DB::table('subastas')
                                ->where('id', $request->input('idSubasta'))
                                ->first();

        $request['creditos'] = session('creditos');
        $request['nombreUsuario'] = session('nombreUsuario');
        $request['nombreInvalido'] = 'Carlos';
        $request['diferencia'] = Carbon::create($subasta->created_at)->diffInDays(Carbon::now());





        $request->validate([
                'creditos' => 'gt: 0',
                'diferencia' => 'lt:3'],
                ['creditos.gt' => 'No posee créditos para poder pujar',
                'diferencia.lt' => 'La subasta ya terminó'
                    ]);

        if($request->input('montoMaximo') == 0)
            $request->validate([
                'valorPuja' => 'required|numeric|bail|gt:montoBase',
                'nombreUsuario' => 'different:nombreInvalido'
                ],
                ['valorPuja.required' => 'Por favor ingrese un monto a pujar', 
                 'valorPuja.numeric' => 'Por favor ingrese un valor numérico',
                  'valorPuja.gt' => 'El valor debe ser mas grande que la puja máxima',
                  'nombreUsuario.different' => 'No posee créditos en la tarjeta'
              ]);
        else
            $request->validate([
                'valorPuja' => 'required|numeric|bail|gt:montoMaximo',
                'nombreUsuario' => 'different:nombreInvalido'
                ],
                ['valorPuja.required' => 'Por favor ingrese un monto a pujar',
                 'valorPuja.numeric' => 'Por favor ingrese un valor numérico',
                 'valorPuja.gt' => 'El valor debe ser mas grande que la puja máxima',
                 'nombreUsuario.different' => 'No posee créditos en la tarjeta']);

        $puja = new Participa;
        $puja->puja = $request->input('valorPuja');
        $puja->id_subasta = $request->input('idSubasta');
        $puja->id_usuario = session('idUsuario');

        $puja->save();

        
        $id = $request->input('idSubasta');
        return redirect()->route('cargardetallesubasta', [$id]);
    }

    public function listarSubastas(Request $request){

        //return $request->route('nombreParametro');

        $data['subastas'] = DB::table('subastas')->whereNull('ganador')->get();
        

        return view('/layouts/listarSubastas', $data);
    }

    public function cerrarSubasta(Request $request){

        $subasta = DB::table('subastas')
                                ->where('id', $request->input('idSubasta'))
                                ->first();     

        $request['diferencia'] = Carbon::create($subasta->created_at)->diffInDays(Carbon::now());
        
        $request->validate([
                'diferencia' => 'gte:3'],
                ['diferencia.gte' => 'La subasta todavía no terminó'
                    ]); 

        $maximaPuja = DB::table('participas')
                    ->select('id_usuario','puja')
                    ->where('id_subasta', $subasta->id)
                    ->whereRaw('puja = (SELECT MAX(puja) as puja FROM participas
                                WHERE id_subasta = ?)', [$subasta->id])
                    ->first();      

        DB::table('subastas')
            ->where('id', $subasta->id)
            ->update(['monto_maximo' => $maximaPuja->puja, 'ganador' => $maximaPuja->id_usuario]);

        return redirect()->back();    
    }
}
