<?php 
use Illuminate\Support\Facades\DB;	
namespace App\Http\Controllers;
use Carbon\Carbon;
?>
@extends('layouts.baseapp')

@section('content')


<div class="conteiner col-md-12" style="margin-bottom: 50px">


	<h1 class="col-md-12 text-center bg-info" style="border-radius: 25px;border-style: double; margin-bottom: 30px"> {{ $tituloHospedaje }}  </h1>


    @include('inc.mensajeExito')
	<div class="col-md-2"></div>


	<div class="col-md-8">
		<div class="card text-white bg-dark" style="border-radius: 35px;" >
			<img src="/images/{{ $nombreImagen }}" style="margin-right: 20px;margin-left: 20px; margin-top: 20px; padding: 20px;border-radius: 40px;" width="750" height="530">
			<div class="card-body" style="margin-right: 20px; margin-left: 20px"	>	
				<hr>

				<p>
					<h3>Descripcion</h3> 
					<p>{{ $descripcion }}</p> 
				</p>

				<hr>
				
				<h3>Información</h3>

				<p>Cantidad maxima de personas: {{ $maximasPersonas }} </p>

				<p>Hospedaje tipo: {{ $tipoHospedaje }} </p>

				<p>Ubicado en: {{ $localidad }} </p>

				<hr>
				
				<h3>Disponibilidad</h3>   

				<p>Disponibile desde {{ Carbon::parse($fechaInicio)->format('d-m-Y') }} hasta {{ Carbon::parse($fechaFin)->format('d-m-Y') }} </p>   

			</div>
			<div>

				<form action="/eliminarHospedaje" method="post">
					{{ csrf_field() }}
					<button class="btn btn-danger float-right" style="margin-right: 20px; margin-bottom: 20px" ><span class="glyphicon glyphicon-trash"></span> Eliminar hospedaje</button>
					<input type="hidden" name="idHospedaje" value="{{ $idHospedaje }}">

				</form>

				<a class="btn btn-warning float-right" style="margin-right: 20px; margin-bottom: 20px" href="{{ url('/modificarHospedaje/'.$idHospedaje) }}"><span class="glyphicon glyphicon-pencil"></span> Modificar hospedaje</a>

				<a class="btn btn-success float-right" style="margin-right: 20px; margin-bottom: 20px" href="{{ url('/crearsubasta/'.$idHospedaje) }}"><span class="glyphicon glyphicon-plus"></span> Crear Subasta</a>
			
				
			</div>
		</div>
	</div>
</div>


@endsection

