<?php 	
	namespace App\Http\Controllers;
  	use Carbon\Carbon;
	$fechaInicio = Carbon::create($fechaInicio); 	
	$fechaFin = Carbon::create($fechaFin);
?>

@extends('layouts.baseapp')


@section('content')
	<div class="container">		
		<br>
			<div class="media">
				<img class="align-self-start mr-3" width="400" height="300" src="/images/<?php echo $nombreImagen; ?>" alt="Generic placeholder image"> <!--Esta imagen es el logo porque todavia nome puedo cargar imagenes a la base de datos sin el "crear subasta". Cuando este lo cambio-->
				<div class="media-body">
					<div class="col-md-8">
						<div class="card">
						  <h3 class="mt-0  card-header card-primary no-margin" style="text-align:center"><b>{{ $tituloHospedaje }}</b><span class="fa fa-map pull-right"></span></h3>
						  <div class="card-block" style="margin: 15px">
									<p><b>Maximas personas hospedaje:</b> {{ $maximasPersonas }}</p> 
									<p><b>Descripción hospedaje:</b> {{ $descripcion }}</p> 
									<p><b>Fecha inicio subasta:</b> {{ $fechaInicio->format('d-m-Y') }}</p>  
									<p><b>Fecha fin subasta:</b> {{ $fechaFin->format('d-m-Y') }}</p> 
									<p><b>Monto base subasta:</b> ${{ $montoBase }}</p>  
									
									<p><b>Maxima puja:</b> 
										@if($montoMaximo == 0)
									 		Nadie pujó todavía
									 	@else	
									 		${{$montoMaximo}}
									 	@endif	
									</p>
									<p><b>Usuario:</b> 
										 	{{$maximoUsuario}}
									</p>
										<form class='form' method='post' action='/pujarsubasta'>
										{{ csrf_field() }}
										<input type="text"   name="valorPuja" placeholder="Ingrese monto a pujar">
										<input type="hidden"   name="montoMaximo" value="{{$montoMaximo}}">
										<input type="hidden"   name="maximoUsuario" value="{{$maximoUsuario}}">
										<input type="hidden"   name="montoBase" value="{{$montoBase}}">
										<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
										 <button class="btn btn-primary" type='submit'>Pujar</button>
									</form>
									@if ($errors->any())
									    <div class="alert alert-danger">
									        <ul>
									            @foreach ($errors->all() as $error)
									                <li>{{ $error }}</li>
									            @endforeach
									        </ul>
									    </div>
									@endif
								</div>
							</div>
					</div>
		  		</div>
			</div>
	</div>
		
@endsection