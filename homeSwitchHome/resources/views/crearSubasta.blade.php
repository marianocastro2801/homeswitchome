

@extends('layouts.baseapp')


@section('content')
		

		<div id="container">
			<div id="main">
				<p>Podes acceder a las variables de fecha de inicio libre del hospedaje usando <?php
						echo '{{'.'$fechaInicioHospedaje'.'}}';
					?> y <?php
						echo '{{'.'$fechaFinHospedaje'.'}}';
					?> </p>


			<div  id="cent" class="text-center">
				<h1>Crear nueva subasta para el hospedaje {{$titulo}}</h1>
				<div id="centrado" class="col-md-8 text-center border rounded shadow-sm">
			<form action="/crearsubasta/validar" method="post">
				{{ csrf_field() }}
			    <div class="form-group">
			      	<label for="montoBase">Monto base</label>
		     		 <input type="text" class="form-control form-control-sm" name="montoBase" id="montoBase" placeholder="Monto base de la subasta">
			    </div>
			  	<div class="form-group">
			      	<label for="fechaInicio">Fecha inicial</label>
		      		<input type="date" class="form-control form-control-sm" name="fechaInicio" id="fechaInicio">
				</div>
				<input type="hidden" name="fechaInicioHospedaje" value="{{$fechaInicioHospedaje}}">
				<input type="hidden" name="fechaFinHospedaje" value="{{$fechaFinHospedaje}}">
				<input type="hidden" name="idHospedaje" value="{{$idHospedaje}}">
			  	<div class="form-group">
			  		<button type="submit" class="btn btn-primary">Crear subasta</button>
			  		<a class="btn btn-secondary my-2 my-sm-0" href="{{ url('/') }}">Cancelar</a>
				</div>
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
	
@endsection