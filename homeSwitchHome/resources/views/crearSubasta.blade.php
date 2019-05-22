@extends('layouts.baseapp')


@section('content')
		

		<div class="container">
			<div id="main" >
				<div class="col-md-6">
					<div id="" class="card" style="border-radius: 25px;">	
						<div class="mt-0 card-header card-primary no-margin text-center" style="border-radius: 25px;">
							<h1>Crear nueva subasta para el hospedaje {{$titulo}}</h1>
							<div class="card-block">
								<div class="text-center rounded">
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
					<br>
					<div class="alert alert-info text-center">
						<p>
							Hospedaje activo desde la fecha
							{{ Carbon\Carbon::parse($fechaInicioHospedaje)->format('d-m-Y') }}
							hasta
							{{ Carbon\Carbon::parse($fechaFinHospedaje)->format('d-m-Y') }}.
							
						</p>
					</div>
				</div>
			</div>
		</div>
	
@endsection