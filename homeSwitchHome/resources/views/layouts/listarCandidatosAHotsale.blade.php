
@extends('layouts.baseapp')


@section('content')
@include('inc.mensajeExito')

<div class="container col-md-10">
	<h1 class="col-md-12 text-center bg-info" style="margin-top:20px; margin-bottom: 30px;border-radius: 25px;border-style: double;"> Candidatos a Hotesale
	</h1>
	<div class="row">
		@if((count($candidatosAHotsales)) == 0)
			<div class="container text-center bg-warning" style="border-radius: 25px; margin-bottom: 60px"><br><p><b>No hay hotsales disponibles</p></b><br></div>
		@else
			@foreach($candidatosAHotsales as $candidatoAHotsales)
				<?php
					$hospedaje = DB::table('hospedajes')
						->select('titulo', 'imagen' )
						->where('id', $candidatoAHotsales->id_hospedaje)
						->first();
				?>
			<div class="col-md-4">
				<div class="jumbotron bg-dark text-white m-1" style="border-radius: 35px">
					<div class="text-center"style="margin-top: -30px">
						<h3>{{$hospedaje->titulo}}</h3>
					</div>
					<hr>
					<img src="/images/{{ $hospedaje->imagen }}" width="300" height="210" style="display:block; margin:auto">
					<hr>
						<p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($candidatoAHotsales->fecha_inicio)->format('d-m-Y') }} </p>
						<p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($candidatoAHotsales->fecha_fin)->format('d-m-Y') }}</p>
						<hr>
						<a class="btn btn-info float-right" href="{{ url('/pasarahotsale/'.$candidatoAHotsales->id) }}">
							Pasar a Hotsale
						</a>
				</div>
			</div>
			@endforeach
		@endif
	</div>
</div>

@endsection
