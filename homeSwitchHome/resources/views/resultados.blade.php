@if(count($subastas) == 0)
	<p> No se encontraron resultados </p>
@else	
	@foreach($subastas as $subasta)
		{{ $subasta->id }}
	@endforeach
@endif	