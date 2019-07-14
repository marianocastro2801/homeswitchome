@extends('layouts.baseapp')

@section('content')
<div class="container" style="margin-top: 50px">
	<div class="row">
		<!--Todos los usuarios-->
		<div class="col-md-6">
			@if(count($usuarios) == 0)
				<div style="background: #ffae42; padding: 50px; border-radius: 25px" class="text-center"><b>No hay usuarios en el sistema</b></div>
			@else
				<table class="table table-striped table-dark">
					<thead>
						<tr>
					      <th scope="col">Usuarios</th>
					      <th scope="col" class="text-center">Cambiar tipo</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
							<tr>
								<th scope="row">{{ $usuario->apellido.' '.$usuario->nombre }}</th>
								@if($usuario->es_premium)
								<td class="text-center">
									<a href="{{ url('/pasarabasico/'.$usuario->id) }}" class="btn btn-sm btn-warning">Pasar a básico</a>
								</td>
								@else
								<td class="text-center">
									<a href="{{ url('/pasarapremium/'.$usuario->id) }}" class="btn btn-sm btn-primary">Pasar a premium</a>
								</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
		<!--Todos los usuarios que pidieron ser premium-->
		<div class="col-md-6">
			@if(count($solicitantes) == 0)
				<div style="background: #ffae42; padding: 50px; border-radius: 25px" class="text-center"><b>Ningun usuario solicito premium</b></div>
			@else
				<table class="table table-striped table-dark">
					<thead>
						<tr>
					      <th scope="col">Usuarios solicitantes</th>
					      <th scope="col" class="text-center">Premium</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($solicitantes as $solicitante)
								<tr>
									<th scope="row">{{ $solicitante->apellido.' '.$solicitante->nombre }}</th>
									<td class="text-center">
										<a href="{{ url('/aceptarsolicitante/'.$solicitante->id) }}" class="btn btn-sm btn-success">Aceptar</a>
										<a href="{{ url('/rechazarsolicitante/'.$solicitante->id) }}" class="btn btn-sm btn-danger">Rechazar</a>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
@endsection
