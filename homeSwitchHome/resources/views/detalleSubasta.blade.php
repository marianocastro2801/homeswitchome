<?php 	
	namespace App\Http\Controllers;
  	use Carbon\Carbon;
	$fechaInicio = Carbon::create($fechaInicio); 	
	$fechaFin = Carbon::create($fechaFin);
	$hoy = Carbon::today();
?>

@extends('layouts.baseapp')


@section('content')

<div class="container">
	<div class="col-md-12">
		@include('inc.mensajeExito')
			@include('inc.mensajeError')
		<div class="col-md-2"></div>
		<div class="col-md-8 text-white" >
			
			<div class="panel bg-dark" style="border-radius: 25px;padding: 40px; margin-bottom: 55px">
				<h3 class="mt-0 bg-info" style="text-align:center;border-radius: 25px;">
					<b>
						{{ $tituloHospedaje }}
					</b>
				</h3>
				<br>
				<img align="center" width="400" height="300" style="border-radius: 25px;display:block; margin:auto;" src="/images/<?php echo $nombreImagen; ?>" alt="Generic placeholder image">
				<br>
				<hr>
				<p>
					<b>Maximas personas hospedaje:</b> {{ $maximasPersonas }}
				</p> 
				<br>
				<p>
					<b>Descripción hospedaje:</b> {{ $descripcion }}
				</p>
				<hr> 
				<p>
					<b>Fecha inicio alojamiento:</b> {{ $fechaInicio->format('d-m-Y') }}
				</p>  
				<p>
					<b>Fecha fin alojamiento:</b> {{ $fechaFin->format('d-m-Y') }}
				</p>
				<hr> 
				<p>
					<b>Monto base subasta:</b> ${{ $montoBase }}
				</p>  					
				<p>
					<b>Maxima puja:</b> 
					@if($montoMaximo == 0)
						Nadie pujó todavía
					@else	
						${{$montoMaximo}}
					@endif	
				</p>
				<p>
					<b>Usuario:</b> 
					{{$maximoUsuario}}
				</p>
				<hr>
				@if(( Session('nombreUsuario') != 'Andrea') && ($fechaInicioSubasta <= $hoy) && ($fechaFinSubasta > $hoy))
					<form class='form' method='post' action='/pujarsubasta'>
						{{ csrf_field() }}
						<div class="col-group col-md-12">
							<span class="col-md-1 col-group glyphicon glyphicon-usd" style="margin-top: 10px">
							</span>
							<input type="text"  class="form-control col-md-6 col-group" name="valorPuja" placeholder="Ingrese monto">
							<input type="hidden"   name="montoMaximo" value="{{$montoMaximo}}">
							<input type="hidden"   name="maximoUsuario" value="{{$maximoUsuario}}">
							<input type="hidden"   name="montoBase" value="{{$montoBase}}">
							<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
							<button class="col-md-4 col-group btn btn-success" type='submit'>
								Pujar
							</button>
						</div>
					</form>	
				@endif
				<br>
				<p style="padding-top: 35px" class="text-center">{{ $diferencia }}</p>
					@if(Session('nombreUsuario')=='Andrea')
						<form action="/cerrarsubasta" method="post">
							{{ csrf_field() }}
							<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
							<button type="submit" class="float-right btn btn-danger">
								Cerrar subasta
							</button>
						</form>
					@endif
					@if(Session('nombreUsuario')!='Andrea')
					<form method='post' action='/inscribirse'>
						{{ csrf_field() }}
						<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">		
						<button type="submit" class="float-right btn btn-danger">
							Inscribirse a subasta
						</button>
					</form>
					@endif
			</div>
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
</div>
@endsection