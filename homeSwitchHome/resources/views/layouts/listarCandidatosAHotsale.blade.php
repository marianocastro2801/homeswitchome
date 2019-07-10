
@extends('layouts.baseapp')


@section('content')
@include('inc.mensajeExito')

<p>candidatos a HotSale</p>

@foreach($candidatosAHotsales as $candidatoAHotsales)
<?php
	$hospedaje = DB::table('hospedajes')
		->select('titulo', 'imagen' )
		->where('id', $candidatoAHotsales->id_hospedaje)
		->first();
		echo $hospedaje->titulo;
?>
<div class="col-md-4">
		<img src="/images/{{ $hospedaje->imagen }}" width="250" height="160" style="display:block; margin:auto">
	</div>
	<div class="col-md-8" style="padding-top: 20px; padding-left: 20px">
		<p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($candidatoAHotsales->fecha_inicio)->format('d-m-Y') }} </p>
		<p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($candidatoAHotsales->fecha_fin)->format('d-m-Y') }}</p>

		<a class="btn btn-info float-right" href="{{ url('/pasarahotsale/'.$candidatoAHotsales->id) }}">
			Pasar a Hotsale
		</a>
		<hr>
</div>
@endforeach

@endsection
