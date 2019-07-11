<?php
	namespace App\Http\Controllers;
  	use Carbon\Carbon;
	$fechaInicio = Carbon::create($fechaInicio);
	$fechaFin = Carbon::create($fechaFin);
	$hoy = Carbon::today();
?>


@extends('layouts.baseapp')
@section('content')
@include('inc.mensajeError')

<div class="container">
	<div class="row">
		<h1 class="col-md-12 text-center bg-info" style="margin-top:20px; margin-bottom: 30px;border-radius: 25px;border-style: double;"> {{ $tituloHospedaje }}
		</h1>
		<br>
		<div class="col-md-3">

		</div>
		<div class="jumbotron col-md-6">
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

			<form class='form' method='post' action='/guardarhotsale'>
				{{ csrf_field() }}
				<div class="row">
					<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
					<input type="text"  class="form-control col-md-6 col-group" name="precioBase" placeholder="Ingrese precio del Hotsale">
					<button class="col-md-3 col-group btn btn-success" type='submit'>
						Crear
					</button>
					<a class="btn btn-secondary col-md-3 col-group  btn-danger " href="{{ url('/candidatoshotsale') }}">Cancelar</a>
				</div>
			</form>
		</div>
	</div>

	<br> <br>
</div>


@endsection
