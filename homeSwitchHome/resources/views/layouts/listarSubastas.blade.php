<?php
use Illuminate\Support\Facades\DB;

?>
@extends('layouts.baseapp')

@section('content')
	<div class="container col-md-12" style="margin-bottom: 50px" >
		<h1 class="col-md-12 text-center bg-info" style="margin-top: 20px ;margin-bottom: 30px;border-radius: 25px;border-style: double;"> Hospedajes </h1>
		<div class="row">
		<div class="col-md-2"></div>
		<div class=" col-md-8 col-centered">
			@foreach($subastasEnPeriodo as $subasta)
				<div class="card card-primary">
			  		<div class="card-heading">
			    		<h3 style="margin-top: 5px" class="card-title text-center">
			    			<b><?php
								$hospedaje = DB::table('hospedajes')
								->select('titulo', 'imagen' )
				                ->where('id', $subasta->id_hospedaje)
				                ->first();
				                echo $hospedaje->titulo;
				   			?></b>
				   		</h3>
				   		<hr>
				   	</div>
			  		<div class="card-body">
			  			<div class="row">
				  			<div class="col-md-4">
				  			<img src="/images/{{ $hospedaje->imagen }}" width="250" height="160" style="display:block; margin:auto">
				  			</div>
				  			<div class="col-md-8" style="padding-top: 20px; padding-left: 20px">
							    <p><b>Monto base:</b> ${{ $subasta->monto_base }}</p>
								<p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }} </p>
								<p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}</p>
								<hr>
								<a class="btn btn-info float-right" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}"> 
			                                    Ver detalles subasta
			                            </a>
		                    </div>
	                    </div>
					</div>
				</div>
				<br>
			@endforeach
		</div>
		<div class="col-md-2"></div>
		</div>
		<div class="row">
		<div class="col-md-2"></div>
		<div class=" col-md-8 col-centered">
			@foreach($subastasEnInscripcion as $subasta)
				<div class="card" style="border-radius: 25px; background: #c8c8c8">
			  		<div class="card-heading">
			    		<h3 style="margin-top: 5px" class="card-title text-center">
			    			<b><?php
								$hospedaje = DB::table('hospedajes')
								->select('titulo', 'imagen' )
				                ->where('id', $subasta->id_hospedaje)
				                ->first();
				                echo $hospedaje->titulo;
				   			?></b>
				   		</h3>
				   		<hr>
				   	</div>
			  		<div class="card-body">
			  			<div class="row">
			  				<div class="col-md-4">
				  			<img src="/images/{{ $hospedaje->imagen }}" width="250" height="160" style="display:block; margin:auto">
				  			</div>
				  			<div class="col-md-8" style="padding-top: 20px; padding-left: 20px">
							    <p><b>Monto base:</b> ${{ $subasta->monto_base }}</p>
								<p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }} </p>
								<p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}</p>
								<hr>
								<a class="btn btn-info float-right" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}">
			                                    Ver detalles subasta
			                            </a>
		                    </div>
	                    </div>
					</div>
				</div>
				<br>
			@endforeach
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
@endsection
