<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use App\Subasta;
use App\Participa;
use App\Reserva;
use App\Inscripcion;
use App\Notificacion;


class SubastasController extends Controller
{
    public function crearSubasta($idHospedaje){
        
        $hospedaje = DB::table('hospedajes')
                    ->where('id', $idHospedaje)
                    ->first();

        $subastas = DB::table('subastas')
                    ->where('id_hospedaje', $idHospedaje)
                    ->whereNull('ganador')
                    ->orderBy('fecha_inicio')
                    ->get();          

        $data['titulo'] = $hospedaje->titulo;
        $data['idHospedaje'] = $hospedaje->id;
        $data['fechaInicioHospedaje'] = $hospedaje->fecha_inicio;   
        $data['fechaFinHospedaje'] = $hospedaje->fecha_fin; 
        $data['subastas'] = $subastas;         

        return view('crearSubasta', $data);
    } 

    public function validar(Request $request){

        $fechaInicioInscripcion = Carbon::create($request->input('fechaInicio'))->startOfWeek()->subMonths(12);
        $fechaFinSubasta = Carbon::create($request->input('fechaInicio'))->startOfWeek()->subMonths(6);
        $fechaInicioSubasta = Carbon::create($request->input('fechaInicio'))->startOfWeek()->subMonths(6)->subDays(3);


        $fechaInicio = Carbon::create($request->input('fechaInicio'));
        $fechaInicio = $fechaInicio->startOfWeek();
        $fechaFin = Carbon::create($request->input('fechaInicio'))->startOfWeek()->addDays(6)->format('Y-m-d');
        $request['fechaInicio'] = $fechaInicio;
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
                    ->where('fecha_inicio', '<=', $request->input('fechaInicio'))
                    ->Where('fecha_fin', '>=', $request->input('fechaFin'))
                    ->where('id_hospedaje', $request->input('idHospedaje'))
                    ->count();

        $request['cantidadSubastas'] = $subastas;

        $request->validate([
            'cantidadSubastas' => 'lt:1'],
            ['cantidadSubastas.lt' => 'La fecha ingresada se superpone con otra subasta' ]);

    	$subasta = new Subasta;
    	$subasta->monto_base = $request->input('montoBase');
    	$subasta->fecha_inicio = $fechaInicio;
        $subasta->fecha_fin = $fechaFin;
        $subasta->fecha_inicio_inscripcion = $fechaInicioInscripcion;
        $subasta->fecha_inicio_subasta = $fechaInicioSubasta;
        $subasta->fecha_fin_subasta = $fechaFinSubasta;
    	$subasta->id_hospedaje = $request->input('idHospedaje');

    	$subasta->save();

    	return redirect('/')->with(['exito' => 'La subasta se creo con éxito.']);
    }

    public function detalleSubasta($idSubasta){

        $subasta = DB::table('subastas')->where('id', $idSubasta)->first();
        $hospedaje = DB::table('hospedajes')->where('id', $subasta->id_hospedaje)->first();
        $hoy = Carbon::today();
        
        if($hoy < $subasta->fecha_inicio_subasta){
            $data['diferencia'] = Carbon::create($subasta->fecha_inicio_subasta)->diffInDays($hoy);
            $data['diferencia'] = 'La subasta comienza el '.Carbon::create($subasta->fecha_inicio_subasta)->format('d-m-Y');
        }
        elseif ($hoy >= $subasta->fecha_fin_subasta){
            $data['diferencia'] = 'La subasta ya terminó';
        }
        else{
            $data['diferencia'] = $hoy->diffInDays(Carbon::create($subasta->fecha_fin_subasta));
            $data['diferencia'] = 'Faltan '.$data['diferencia'].' días para que la subasta termine';
        }
                
        $data['tituloHospedaje'] = $hospedaje->titulo;
        $data['maximasPersonas'] = $hospedaje->cantidad_maxima_personas; 
        $data['descripcion'] = $hospedaje->descripcion;    
        $data['nombreImagen'] = $hospedaje->imagen;   
        $data['idSubasta'] = $subasta->id;
        $data['montoBase'] = $subasta->monto_base;
        $data['fechaInicioInscripcion'] = $subasta->fecha_inicio_inscripcion;
        $data['fechaInicioSubasta'] = $subasta->fecha_inicio_subasta;
        $data['fechaFinSubasta'] = $subasta->fecha_fin_subasta;
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
        $request['hoy'] = Carbon::today();
        //$request['nombreInvalido'] = 'Carlos';


        $request->validate([
                'creditos' => 'gt: 0'],
                ['creditos.gt' => 'No posee créditos para poder pujar'
                    ]);

        if($request->input('montoMaximo') == 0)
            $request->validate([
                'valorPuja' => 'required|numeric|bail|gte:montoBase'
                //Queda comentado hasta saber si el credito tarjeta es en pujar o cerrar
                //,'nombreUsuario' => 'different:nombreInvalido'
                ],
                ['valorPuja.required' => 'Por favor ingrese un monto a pujar', 
                 'valorPuja.numeric' => 'Por favor ingrese un valor numérico',
                  'valorPuja.gt' => 'El valor debe ser mas grande que la puja base'
              ]);
        else
            $request->validate([
                'valorPuja' => 'required|numeric|bail|gt:montoMaximo'
                //Queda comentado hasta saber si el credito tarjeta es en pujar o cerrar
                //,'nombreUsuario' => 'different:nombreInvalido'
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

    public function listarSubastas(){

        $hoy = Carbon::today()->format('Y-m-d');

        $data['subastasEnInscripcion'] = DB::table('subastas')
                            ->whereNull('ganador')
                            ->whereDate('fecha_inicio_inscripcion', '<=' , $hoy)
                            ->whereDate('fecha_inicio_subasta', '>' , $hoy)
                            ->orderBy('fecha_inicio', 'asc')
                            ->get();

        $data['subastasEnPeriodo'] = DB::table('subastas')
                            ->whereNull('ganador')
                            ->whereDate('fecha_inicio_subasta', '<=' , $hoy)
                            ->orderBy('fecha_inicio', 'asc')
                            ->get();
        

        return view('/layouts/listarSubastas', $data);
    }

    public function cerrarSubasta(Request $request){

        $subasta = DB::table('subastas')
                    ->where('id', $request->input('idSubasta'))
                    ->first();

        //Usuario sin crédito en la tarjeta
        $request['usuarioInvalido'] = 2; 
        $request['hoy'] = Carbon::today();
        //Agregado para poder tirar el error correspondiente
        $request['diaAnteriorAlIncio'] = Carbon::create($subasta->fecha_inicio_subasta)->subDay();

        $request->validate([
                'hoy' => 'after:diaAnteriorAlIncio|bail|after_or_equal:'.$subasta->fecha_fin_subasta],
                ['hoy.after' => 'La subasta todavía no comenzó',
                 'hoy.after_or_equal' => 'La subasta todavía no terminó',
                    ]); 

        // Codigo para obtener el maximo de algo
        // $pujas = DB::table('participas')
        //             ->select('id_usuario','puja')
        //             ->where('id_subasta', $subasta->id)
        //             ->whereRaw('puja = (SELECT MAX(puja) as puja FROM participas
        //                         WHERE id_subasta = ?)', [$subasta->id])
        //             ->get();

        $pujas = DB::table('participas')
                    ->select('id_usuario','puja')
                    ->where('id_subasta', $subasta->id)
                    ->orderBy('puja', 'desc')
                    ->get();           

        DB::table('subastas')
        ->where('id', $subasta->id)
        ->update(['monto_maximo' => 0, 'ganador' => 0]);

        $request->session()->flash('exito', 'La subasta se cerro con exito sin ganadores. La subasta se ha agregado a la lista de candidatos de Hotsale');

        foreach ($pujas as $puja){
            
            $tieneReservaEnLaSemana = false;

            $usuario = DB::table('usuarios')
                ->where('id', $puja->id_usuario)
                ->first();

            $reservas = DB::table('reservas')
                ->where('id_usuario', $puja->id_usuario)
                ->get();    

            foreach ($reservas as $reserva){
                    $subastaDeReserva = DB::table('subastas')
                        ->where('id', $reserva->id_subasta)
                        ->first();

                    if($subastaDeReserva->fecha_inicio == $subasta->fecha_inicio){
                        $tieneReservaEnLaSemana = true;
                    }
                }  

            if(($usuario->id != $request->input('usuarioInvalido') &&  ($usuario->creditos > 0) && (!$tieneReservaEnLaSemana))){
                DB::table('subastas')
                ->where('id', $subasta->id)
                ->update(['monto_maximo' => $puja->puja, 'ganador' => $puja->id_usuario]);

                DB::table('usuarios')
                ->where('id', $puja->id_usuario)
                ->decrement('creditos');

                $reserva = new Reserva;
                $reserva->id_usuario = $puja->id_usuario;
                $reserva->id_subasta = $subasta->id;

                $reserva->save(); 

                $hospedaje = DB::table('hospedajes')
                            ->where('id', $request->input('idSubasta'))
                            ->first();

                $notificacion = new Notificacion;
                $notificacion->id_usuario = $puja->id_usuario;
                $notificacion->mensaje = "Gano la subasta ".$hospedaje->titulo." para alojarse desde ".Carbon::parse($subasta->fecha_inicio)->format('d-m-Y')." hasta ".Carbon::parse($subasta->fecha_fin)->format('d-m-Y');

                $notificacion->save(); 

                $request->session()->flash('exito', 'La subasta se cerro con exito, el ganador es '.$usuario->email);

                break;
            }
        }
        

        return redirect('/');    
    }

    public function inscribirse(Request $request){

        $inscripcion = new Inscripcion;
        $inscripcion->id_subasta = $request->input('idSubasta');
        $inscripcion->id_usuario = session('idUsuario');

        $inscripcion->save();

        return redirect('/cargardetallesubasta/'.$request->input('idSubasta'))->with(['exito' => 'Se inscribió exitosamente a la subasta']);
    }
}
