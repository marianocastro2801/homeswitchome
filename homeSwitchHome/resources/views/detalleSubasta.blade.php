<?php 	
	namespace App\Http\Controllers;
  	use Carbon\Carbon;
	$fechaInicio = Carbon::create($fechaInicio); 
	$fechaFin = Carbon::create($fechaFin);
	?>

 <p>Titulo hospedaje: {{ $tituloHospedaje }}</p>  
 <p>Maximas personas hospedaje: {{ $maximasPersonas }}</p> 
 <p>Descripción hospedaje: {{ $descripcion }}</p> 
 <p>Fecha inicio subasta: {{ $fechaInicio->format('d-m-Y') }}</p>  
 <p>Fecha fin subasta: {{ $fechaFin->format('d-m-Y') }}</p> 
 <p>Monto base subasta: ${{ $montoBase }}</p>  
 <img src="/images/{{ $nombreImagen }}">

<p>Maxima puja: 
	@if($montoMaximo == 0)
 		Nadie pujó todavía
 	@else	
 		${{$montoMaximo}}
 	@endif	
</p>
<p>
	Usuario: 
	 	{{$maximoUsuario}}
</p>

<form class='form' method='post' action='/pujarsubasta'>
	{{ csrf_field() }}
	<input type="text"   name="valorPuja" placeholder="Ingrese monto a pujar">
	<input type="hidden"   name="montoMaximo" value="{{$montoMaximo}}">
	<input type="hidden"   name="maximoUsuario" value="{{$maximoUsuario}}">
	<input type="hidden"   name="montoBase" value="{{$montoBase}}">
	<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
	 <button class="btn btn-primary" type='submit'>Pujar</button>
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
