<?php 	
	namespace App\Http\Controllers;
  	use Carbon\Carbon;
	$fechaInicio = Carbon::create($fechaInicio); 	
	$fechaFin = Carbon::create($fechaFin);
?>

@extends('layouts.baseapp')


@section('content')
	<div class="container" style="margin-bottom: 60px">		
		<br>
			<div class="media" >
				<img class="align-self-start mr-3" width="400" height="300" style="border-radius: 25px;" src="/images/<?php echo $nombreImagen; ?>" alt="Generic placeholder image">
				<div class="media-body" style="margin-left: 30px">
					<div class="col-md-12">
						<div class="card" >
						  <h3 class="mt-0  card-header bg-info no-margin" style="text-align:center"><b>{{ $tituloHospedaje }}</b><span class="fa fa-map pull-right"></span></h3>
						  <div class="card-block" style="margin: 15px">
									<p><b>Maximas personas hospedaje:</b> {{ $maximasPersonas }}</p> 
									<p><b>Descripción hospedaje:</b> {{ $descripcion }}</p>
									<hr> 
									<p><b>Fecha inicio subasta:</b> {{ $fechaInicio->format('d-m-Y') }}</p>  
									<p><b>Fecha fin subasta:</b> {{ $fechaFin->format('d-m-Y') }}</p>
									<hr> 
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
									<hr>
									@if( Session('nombreUsuario') != 'Andrea')
										<form class='form' method='post' action='/pujarsubasta'>
											{{ csrf_field() }}
											<div class="col-xs-5">
												<input type="text"  class="form-control" name="valorPuja" placeholder="$">
												<input type="hidden"   name="montoMaximo" value="{{$montoMaximo}}">
												<input type="hidden"   name="maximoUsuario" value="{{$maximoUsuario}}">
												<input type="hidden"   name="montoBase" value="{{$montoBase}}">
											<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
											</div>
											<button class="btn btn-success" type='submit'>Pujar</button>
										</form>	
									@endif
									@if(Session('nombreUsuario')=='Andrea')
										<form action="/cerrarsubasta" method="post">
											{{ csrf_field() }}
											<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
											<button type="submit" class="float-right btn btn-danger">Cerrar subasta</button>
										</form>
									@endif
									@if ($errors->any())
										<br>
									    <div class="alert alert-danger">
									        <ul>
									            @foreach ($errors->all() as $error)
									            	<button class="close" data-dismiss="alert"><span>&times;</span></button>
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