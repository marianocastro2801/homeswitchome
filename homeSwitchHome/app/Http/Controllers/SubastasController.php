<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;

class SubastasController extends Controller
{
    public function validar(Request $request){

    	$this->validate($request, [
    		'montoBase'=> 'required|numeric',
    		'fechaInicio'=> 'required|before:fechaFin',
    		'fechaFin'=> 'required'],
            ['montoBase.required' => 'Por favor ingrese un monto base', 
             'montoBase.numeric' => 'Por favor ingrese un valor numérico',
             'fechaInicio.before' => 'La fecha de inicio debe ser menor a la fecha de fin',
             'fechaInicio.required' => 'Por favor ingrese una fecha de inicio',
             'fechaFin.required' => 'Por favor ingrese una fecha de finalizacion',
               ]);

    	$subasta = new Subasta;
    	$subasta->monto_base = $request->input('montoBase');
    	$subasta->fecha_inicio = $request->input('fechaInicio');
    	$subasta->fecha_fin = $request->input('fechaFin');
    	$subasta->id_hospedaje = 1;

    	$subasta->save();

    	return redirect('/');
    }
}
