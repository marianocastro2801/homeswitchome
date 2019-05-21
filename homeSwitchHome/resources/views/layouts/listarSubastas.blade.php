<?php 
use Illuminate\Support\Facades\DB;

?>
@extends('layouts.baseapp')

@section('content')
	<div class="container col-md-12" style="margin-bottom: 50px" >
		<div class="col-md-4"></div>
		<div class=" col-md-4 col-centered">
		@foreach($subastas as $subasta)
			<div class="panel panel-primary">
		  		<div class="panel-heading">
		    		<h3 class="panel-title text-center">
		    			<b><?php 
							$tituloHospedaje = DB::table('hospedajes')
							->select('titulo')
			                ->where('id', $subasta->id_hospedaje)
			                ->first();
			                echo $tituloHospedaje->titulo;    
			   			?></b>
			   		</h3>
			   	</div>
		  		<div class="panel-body">
				    <p><b>Monto base de la subasta:</b> ${{ $subasta->monto_base }}</p>
					<p><b>Fecha inicio hospedaje:</b> {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }} </p>
					<p><b>Fecha fin hospedaje:</b> {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}</p>
					<a class="btn btn-info float-right" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}"> 
                                    Ver detalles subasta
                            </a>
				</div>
			</div>
		@endforeach
		</div>
	</div>
@endsection