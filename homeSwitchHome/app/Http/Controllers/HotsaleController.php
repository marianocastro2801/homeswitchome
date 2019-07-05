<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Reserva;
use App\Notificacion;

class HotsaleController extends Controller
{
    public function listarCandidatosHotsale(){
    	
    	$candidatosAHotsale = DB::table('hotsales')
                    ->where('candidato', true)
                    ->get();

        $idSubastas = [-1];
        
        foreach ($candidatosAHotsale as $candidatoAHotsale){
             $idSubastas[] = $candidatoAHotsale->id_subasta;
        }            

        $data['candidatosAHotsales'] = DB::table('subastas')
                    ->whereIn('id', $idSubastas)
                    ->get(); 

                               

        return view('/layouts/listarCandidatosAHotsale', $data);                      
    }

    public function obtenerInformacionHotsale($idSubasta){
    
    	$subasta = DB::table('subastas')->where('id', $idSubasta)->first();
        $hospedaje = DB::table('hospedajes')->where('id', $subasta->id_hospedaje)->first();

        $data['tituloHospedaje'] = $hospedaje->titulo;
        $data['maximasPersonas'] = $hospedaje->cantidad_maxima_personas; 
        $data['descripcion'] = $hospedaje->descripcion;    
        $data['nombreImagen'] = $hospedaje->imagen;   
        $data['idSubasta'] = $subasta->id;
        $data['fechaInicio'] = $subasta->fecha_inicio;
        $data['fechaFin'] = $subasta->fecha_fin;

        return $data;

    }

    public function pasarAHotsale($idSubasta){

    	$data = $this->obtenerInformacionHotsale($idSubasta);

    	return view('pasarAHotsale', $data);
    }

    public function guardarHotsale(Request $request){

    	$request->validate([
                'precioBase' => 'required|bail|numeric'],
                ['precioBase.required' => 'Por favor ingrese un precio base', 
                 'precioBase.numeric' => 'Por favor ingrese un valor numérico'
              ]);
    	
    	DB::table('hotsales')
	        ->where('id_subasta', $request->input('idSubasta'))
	        ->update(['precio_base' => $request->input('precioBase'),
	    			  'candidato' => false]);



        return redirect('/candidatoshotsale')->with(['exito' => 'El hospedaje se pasó hotsale con exito']);                      
    }

    public function listarHotsales(){

    	$candidatosAHotsale = DB::table('hotsales')
                    ->where('candidato', false)
                    ->get();

        $idSubastas = [-1];
        
        foreach ($candidatosAHotsale as $candidatoAHotsale){
             $idSubastas[] = $candidatoAHotsale->id_subasta;
        }            

        $data['hotsales'] = DB::table('subastas')
        			->join('hotsales', 'subastas.id', '=', 'hotsales.id_subasta')
                    ->whereIn('subastas.id', $idSubastas)
                    ->get(); 

    	return view('/layouts/listarHotsales', $data);
    }

    public function reservarHotsale(Request $request){

    	$data = $this->obtenerInformacionHotsale($request->input('idSubasta'));

    	$request['usuarioInvalido'] = session('idUsuario');

		$request->validate([
                'usuarioInvalido' => 'not_in:2'],
                ['usuarioInvalido.not_in' => 'No posee suficiente crédito en la tarjeta']);

		return session('idUsuario');

		$reserva = new Reserva;
        $reserva->id_usuario = session('idUsuario');
        $reserva->id_subasta = $request->input('idSubasta');

        $reserva->save(); 

        DB::table('hotsales')->where('id_subasta', $request->input('idSubasta'))->delete();

        $notificacion = new Notificacion;
        $notificacion->id_usuario = session('idUsuario');
        $notificacion->mensaje = "Usted adquirió el hospedaje ".$data['tituloHospedaje']." para alojarse desde ".Carbon::parse($data['fechaInicio'])->format('d-m-Y')." hasta ".Carbon::parse($data['fechaFin'])->format('d-m-Y');

        $notificacion->save();

        return redirect('/listarhotsales')->with(['exito' => 'Se ha adquirido el hospedaje con exito']);;
    }

    public function adquirirComoPremium(Request $request){

    	$data = $this->obtenerInformacionHotsale($request->input('idSubasta'));

    	$request['creditos'] = session('creditos');

        $request->validate([
                'creditos' => 'gt: 0'],
                ['creditos.gt' => 'No posee créditos para adquirir el hospedaje']);

        DB::table('subastas')
                ->where('id', $$request->input('idSubasta'))
                ->update(['monto_maximo' => 0, 'ganador' => session('idUsuario')]);

        $reserva = new Reserva;
        $reserva->id_usuario = session('idUsuario');
        $reserva->id_subasta = $request->input('idSubasta');

        $reserva->save(); 

        $notificacion = new Notificacion;
        $notificacion->id_usuario = session('idUsuario');
        $notificacion->mensaje = "Usted adquirió como premium el hospedaje ".$data['tituloHospedaje']." para alojarse desde ".Carbon::parse($data['fechaInicio'])->format('d-m-Y')." hasta ".Carbon::parse($data['fechaFin'])->format('d-m-Y');

        $notificacion->save();

        return redirect('/listarsubastas')->with(['exito' => 'Se ha adquirido el hospedaje con exito']);;
    }

}
  