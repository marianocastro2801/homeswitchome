<?php 
use Illuminate\Support\Facades\DB;

?>
@extends('layouts.baseapp')

@section('content')
	<div class="container col-md-12" style="margin-bottom: 50px" >
		<h1 class="col-md-12 text-center bg-info" style=" margin-bottom: 30px"> Hospedajes </h1>
		<div class="col-md-2"></div>
		<div class=" col-md-8 col-centered">
			@foreach($subastas as $subasta)
				<div class="panel panel-primary">
			  		<div class="panel-heading">
			    		<h3 class="panel-title text-center">
			    			<b><?php 
								$hospedaje = DB::table('hospedajes')
								->select('titulo', 'imagen' )
				                ->where('id', $subasta->id_hospedaje)
				                ->first();
				                echo $hospedaje->titulo;    
				   			?></b>
				   		</h3>
				   	</div>
			  		<div class="panel-body">
			  			<div class="col-group">
				  			<img class="col-md-4" src="/images/{{ $hospedaje->imagen }}" width="40" height="140">
				  			<div class="col-md-8" style="padding-top: 20px; padding-left: 20px">
							    <p><b>Monto base:</b> ${{ $subasta->monto_base }}</p>
								<p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }} </p>
								<p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}</p>
								<a class="btn btn-info float-right" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}"> 
			                                    Ver detalles subasta
			                            </a>
		                    </div>
	                    </div>
					</div>
				</div>
			@endforeach
		</div>
		
	</div>
@endsection