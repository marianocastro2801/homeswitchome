<?php 
use Illuminate\Support\Facades\DB;	
namespace App\Http\Controllers;
use Carbon\Carbon;
?>
@extends('layouts.baseapp')

@section('content')
<div class="conteiner col-md-12" style="margin-bottom: 50px">
<div>
	    @if(session('exito'))
	        <div class="alert alert-success">
	            {{ session('exito') }}
	        </div>
	    @endif
</div>
	<h1 class="col-md-12 text-center bg-info" style=" margin-bottom: 30px"> {{ $tituloHospedaje }}  </h1>
	
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="card bg-info" >
			<img src="/images/{{ $nombreImagen }}" height="500">
			<div class="card-body">	
				<div class="card-text"></div>
				<p>
					<h3>Descripcion</h3> 
					<h4>{{ $descripcion }}</h4> 
				</p>
				<h4>Cantidad maxima de personas {{ $maximasPersonas }} </h4>
				<h4>Hospedaje tipo {{ $tipoHospedaje }} </h4>

				<h4>Ubicado en {{ $localidad }} </h4>   

				<h4>Fecha de Inicio {{ $fechaInicio }} </h4>   

				<h4>Fecha fin {{ $fechaFin }} </h4>   
				</div>
				<div>
				<a class="btn btn-success float-left" style="margin-left: 20px; margin-bottom: 20px" href="{{ url('/modificarHospedaje/'.$idHospedaje) }}"> Modificar hospedaje</a>

				<form action="/eliminarHospedaje" method="post">
					{{ csrf_field() }}
					<button class="btn btn-danger float-right" style="margin-right: 20px; margin-bottom: 20px" >Eliminar hospedaje</button>
					<input type="hidden" name="idHospedaje" value="{{ $idHospedaje }}">

				</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

