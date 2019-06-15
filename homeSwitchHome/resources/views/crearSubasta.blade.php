@extends('layouts.baseapp')


@section('content')
		

		<div class="container" style="margin-top: 20px">
			<div id="main" >
				<div class="col-md-6">
					<div style="border-radius: 25px" class="alert alert-info text-center">
						<button class="close" data-dismiss="alert"><span>&times;</span></button>
						<p>
							Hospedaje esta disponible desde la fecha
							{{ Carbon\Carbon::parse($fechaInicioHospedaje)->format('d-m-Y') }}
							hasta
							{{ Carbon\Carbon::parse($fechaFinHospedaje)->format('d-m-Y') }}.
							
						</p>
					</div>
					<div id="" class="card" style="border-radius: 25px;">	
						<div class="mt-0 card-header card-primary no-margin text-center" style="border-radius: 25px;">
							<h1>Crear nueva subasta para el hospedaje {{$titulo}}</h1>
							<hr>
							<div class="card-block">
								<div class="text-center rounded">
									<form action="/crearsubasta/validar" method="post">
										{{ csrf_field() }}
										<div class="form-group col-md-12">
						    				<div class="form-group col-md-1">
						    					<span class="col-md-1 col-group glyphicon glyphicon-usd" style="margin-top: 35px; margin-left: -20px"></span>
						    				</div>
						    				<div class="form-group col-md-11">
						    				  	<label for="montoBase">Monto base</label>
					     		 				<input type="text" class="form-control form-control-sm" name="montoBase" id="montoBase" placeholder="Monto base de la subasta">
						    				</div>
						  					<div class="form-group">
										      	<div class="form-group col-md-1">
										      		<span class="col-md-1 col-group glyphicon glyphicon-calendar" style="margin-top: 35px; margin-left: -20px"></span>
										      	</div>
										      	<div class="form-group col-md-11">
										      	<label for="fechaInicio">Fecha inicial</label>
									      		<input type="date" class="form-control form-control-sm" name="fechaInicio" id="fechaInicio">
									      	</div>
												<p class="text-muted text-center">(La estadía dura 7 dias desde la fecha incial)</p>
											</div>
										</div>
												<br>
												<input type="hidden" name="fechaInicioHospedaje" value="{{$fechaInicioHospedaje}}">
												<input type="hidden" name="fechaFinHospedaje" value="{{$fechaFinHospedaje}}">
												<input type="hidden" name="idHospedaje" value="{{$idHospedaje}}">
											<div class="form-group">
										  		<button type="submit" class="btn btn-primary">Crear subasta</button>
										  		<a class="btn btn-secondary my-2 my-sm-0" href="{{ url('/cargardetallehospedaje'.$idHospedaje) }}">Cancelar</a>
											</div>
									</form>
									@include('inc.mensajeError')
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="jumbotron bg-dark text-white">
						<p class="text-center" style="margin-top: -30px">
							Fechas ocupadas:
						</p>
						@if(count($subastas) == 0)
			                No hay subastas ¿activas? para este hospedaje
			            @endif  
						@foreach($subastas as $subasta)
							<div><span class="glyphicon glyphicon-hand-right" style="margin-right: 10px"></span> Comienza {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }} y termina {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}</div>
						@endforeach						
					</div>
				</div>
			</div>
		</div>
	
@endsection