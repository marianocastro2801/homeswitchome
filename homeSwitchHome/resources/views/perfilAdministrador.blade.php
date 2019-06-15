<h4>Usuarios</h4>
<ul>
	@if(count($usuarios) == 0)
		<div>No hay usuarios en el sistema</div>
	@else
		@foreach($usuarios as $usuario)
			<div>{{ $usuario->apellido.' '.$usuario->nombre }}</div>
			@if($usuario->es_premium)
				<a href="{{ url('/pasarabasico/'.$usuario->id) }}" class="btn">Pasar a básico</a>
			@else
				<a href="{{ url('/pasarapremium/'.$usuario->id) }}" class="btn">Pasar a premium</a>
			@endif	
		@endforeach
	@endif	
</ul>
<h4>Usuarios solicitantes</h4>
<ul>
	@if(count($solicitantes) == 0)
		<div>Ningun usuario solicito premium</div>
	@else
		@foreach($solicitantes as $solicitante)
			<div>{{ $solicitante->apellido.' '.$solicitante->nombre }}</div>
			<a href="{{ url('/pasarsolicitanteapremium/'.$usuario->id) }}" class="btn">Pasar a premium</a>
		@endforeach
	@endif	
</ul>