<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Hospedaje;

class HospedajeController extends Controller
{
    
    public function crearHospedaje(){
        $localidades = DB::table('localidads')
                    ->get();         

        return view('crearHospedaje', ['localidades' => $localidades]);  

    } 


    public function validar(Request $request){

        $request->validate([
        	'titulo' => 'required|bail|unique:hospedajes,titulo',
            'descripcion' => 'required',
            'cantidadPersonas' => 'required',
            'tipoHospedaje' => 'required',
            'localidad' => 'required',
            'fechaInicio' => 'required|before:fechaFin',
            'fechaFin' => 'required',
        	'imagen' => 'required'
        ],
            ['titulo.required' => 'Por favor ingrese un titulo',
            'titulo.unique' => 'El titulo ya se encuentra registrado, por favor ingrese otro titulo',
            'descripcion.required' => 'Por favor ingrese una descripcion',
            'cantidadPersonas.required' => 'Por favor ingrese una cantidad personas',
            'tipoHospedaje.required' => 'Por favor ingrese un tipo vivienda',
            'localidad.required' => 'Por favor ingrese una localidad',
            'imagen.required' => 'Por favor ingrese una imagen', 
             'montoBase.numeric' => 'Por favor ingrese un valor numérico',
             'fechaInicio.required' => 'Por favor ingrese una fecha de inicio',
             'fechaInicio.before' => 'La fecha de inicio debe ser menor a la de fin',
             'fechaFin.required' => 'Por favor ingrese una fecha de fin'
               ]);


		 $imagen = $request->file('imagen');
		 $extension = $imagen->getClientOriginalExtension();
		 $nombreImagen = time().'.'.$extension;
		 $imagen->move(public_path("images"), $nombreImagen);
			
		 $hospedaje = new Hospedaje;
	    	$hospedaje->titulo = $request->input('titulo');
	    	$hospedaje->tipo_hospedaje = $request->input('tipoHospedaje');
	    	$hospedaje->cantidad_maxima_personas = $request->input('cantidadPersonas');
	    	$hospedaje->id_localidad = $request->input('localidad');
	    	$hospedaje->descripcion = $request->input('descripcion');
	    	$hospedaje->fecha_inicio = $request->input('fechaInicio');
	        $hospedaje->fecha_fin = $request->input('fechaFin');
	        $hospedaje->imagen = $nombreImagen;


	   	$hospedaje->save();

	    return redirect('/')->with('exito', 'El hospedaje se creo exitosamente');
    }

    public function listarHospedajes(Request $request){
        //return $request->route('nombreParametro');

        $data['hospedajes'] = DB::table('hospedajes')->get();
        

        return view('/layouts/listarHospedajes', $data);
    }

    public function cargarDetalleHospedaje($idHospedaje){

        $hospedaje = DB::table('hospedajes')->where('id', $idHospedaje)->first();
        $localidad = DB::table('localidads')->where('id', $hospedaje->id_localidad)->first();
                
        $data['idHospedaje'] = $hospedaje->id;
        $data['tituloHospedaje'] = $hospedaje->titulo;
        $data['maximasPersonas'] = $hospedaje->cantidad_maxima_personas; 
        $data['descripcion'] = $hospedaje->descripcion;  
        $data['tipoHospedaje'] = $hospedaje->tipo_hospedaje;  
        $data['nombreImagen'] = $hospedaje->imagen; 
        $data['fechaInicio'] = $hospedaje->fecha_inicio;
        $data['fechaFin'] = $hospedaje->fecha_fin;
        $data['localidad'] = $localidad->nombre;


        return view('detalleHospedaje', $data);
        
     }

     public function eliminarHospedaje(Request $request){

        DB::table('hospedajes')->where('id', $request->input('idHospedaje'))->delete();

        return redirect('/listarhospedajes')->with('exito', 'El hospedaje se creo exitosamente');

     }

     public function modificarHospedaje($idHospedaje){

        $hospedaje = DB::table('hospedajes')->where('id', $idHospedaje)->first();
        $localidad = DB::table('localidads')->where('id', $hospedaje->id_localidad)->first();
        $localidades = DB::table('localidads')->get(); 
                
        $data['idHospedaje'] = $hospedaje->id;
        $data['tituloHospedaje'] = $hospedaje->titulo;
        $data['maximasPersonas'] = $hospedaje->cantidad_maxima_personas; 
        $data['descripcion'] = $hospedaje->descripcion;  
        $data['tipoHospedaje'] = $hospedaje->tipo_hospedaje;
        $data['fechaInicio'] = $hospedaje->fecha_inicio;
        $data['fechaFin'] = $hospedaje->fecha_fin;
        $data['idLocalidad'] = $hospedaje->id_localidad;
        $data['localidad'] = $localidad->nombre;
        $data['localidades'] = $localidades;


        return view('modificarHospedaje', $data);
    }

     public function validarModificacion(Request $request){

        $request->validate([
            'titulo' => 'required|bail|unique:hospedajes,titulo',
            'descripcion' => 'required',
            'cantidadPersonas' => 'required',
            'tipoHospedaje' => 'required',
            'localidad' => 'required',
            'fechaInicio' => 'required|before:fechaFin',
            'fechaFin' => 'required'
        ],
            ['titulo.required' => 'Por favor ingrese un titulo',
            'titulo.unique' => 'El titulo ya se encuentra registrado, por favor ingrese otro titulo',
            'descripcion.required' => 'Por favor ingrese una descripcion',
            'cantidadPersonas.required' => 'Por favor ingrese una cantidad personas',
            'tipoHospedaje.required' => 'Por favor ingrese un tipo vivienda',
            'localidad.required' => 'Por favor ingrese una localidad',
             'montoBase.numeric' => 'Por favor ingrese un valor numérico',
             'fechaInicio.required' => 'Por favor ingrese una fecha de inicio',
             'fechaInicio.before' => 'La fecha de inicio debe ser menor a la de fin',
             'fechaFin.required' => 'Por favor ingrese una fecha de fin'
               ]);

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nombreImagen = time().'.'.$extension;
            $imagen->move(public_path("images"), $nombreImagen);

            DB::table('hospedajes')
            ->where('id', $request->input('idHospedaje'))
            ->update(['titulo' => $request->input('titulo'),
                      'descripcion' => $request->input('descripcion'),
                      'cantidad_maxima_personas' => $request->input('cantidadPersonas'),
                      'tipo_hospedaje' => $request->input('tipoHospedaje'), 
                      'descripcion' => $request->input('descripcion'),
                      'id_localidad' => $request->input('localidad'), 
                      'fecha_inicio' => $request->input('fechaInicio'),
                      'fecha_fin' => $request->input('fechaFin'),
                      'imagen' => $nombreImagen]);
        }
        else{
            DB::table('hospedajes')
            ->where('id', $request->input('idHospedaje'))
            ->update(['titulo' => $request->input('titulo'),
                      'descripcion' => $request->input('descripcion'),
                      'cantidad_maxima_personas' => $request->input('cantidadPersonas'),
                      'tipo_hospedaje' => $request->input('tipoHospedaje'), 
                      'descripcion' => $request->input('descripcion'),
                      'id_localidad' => $request->input('localidad'), 
                      'fecha_inicio' => $request->input('fechaInicio'),
                      'fecha_fin' => $request->input('fechaFin')]);
        }


        return redirect('/cargardetallehospedaje/'.$request->input('idHospedaje'))->with(['exito' => 'Hospedaje modificado con éxito.']);

     }


}
