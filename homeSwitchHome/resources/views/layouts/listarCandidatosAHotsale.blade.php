
@extends('layouts.baseapp')


@section('content')
@include('inc.mensajeExito')

<div class="container">
	<h1 class="col-md-12 text-center bg-info" style="margin-top:20px; margin-bottom: 30px;border-radius: 25px;border-style: double;"> Candidatos a Hotesale
	</h1>
	<div class="row">
		@foreach($candidatosAHotsales as $candidatoAHotsales)
			<?php
				$hospedaje = DB::table('hospedajes')
					->select('titulo', 'imagen' )
					->where('id', $candidatoAHotsales->id_hospedaje)
					->first();
			?>

		<div class="col-md-4 jumbotron bg-dark text-white">
			<h3>{{$hospedaje->titulo}}</h3>
			<hr>
			<img src="/images/{{ $hospedaje->imagen }}" width="250" height="160" style="display:block; margin:auto">
			<hr>
				<p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($candidatoAHotsales->fecha_inicio)->format('d-m-Y') }} </p>
				<p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($candidatoAHotsales->fecha_fin)->format('d-m-Y') }}</p>
				<hr>
				<a class="btn btn-info float-right" href="{{ url('/pasarahotsale/'.$candidatoAHotsales->id) }}">
					Pasar a Hotsale
				</a>
		</div>
		@endforeach
	</div>
</div>

@endsection
