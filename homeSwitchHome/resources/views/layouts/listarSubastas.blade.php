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
		    		<h3 class="panel-title">
		    			<?php 
							$tituloHospedaje = DB::table('hospedajes')
							->select('titulo')
			                ->where('id', $subasta->id_hospedaje)
			                ->first();
			                echo $tituloHospedaje->titulo;    
			   			?>
			   		</h3>
			   	</div>
		  		<div class="panel-body">
				    <p>Monto base de la subasta: ${{ $subasta->monto_base }}</p>
					<p>Fecha inicio hospedaje: {{ $subasta->fecha_inicio }}</p>
					<p>Fecha fin hospedaje: {{ $subasta->fecha_fin }}</p>
				</div>
			</div>
		@endforeach
	</div>
@endsection