<?php 
use Illuminate\Support\Facades\DB;

?>
<style type="text/css">
	#bodybody{
		margin-bottom: 60px;
		margin-top: 60px;
	}
</style>
@extends('layouts.baseapp')

@section('content')
	<div id="cent" style="margin-bottom: 60px;margin-top: 55px;">
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
				</div>
			</div>
		@endforeach
	</div>
@endsection