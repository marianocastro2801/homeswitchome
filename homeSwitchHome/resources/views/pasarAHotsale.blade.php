<?php 	
	namespace App\Http\Controllers;
  	use Carbon\Carbon;
	$fechaInicio = Carbon::create($fechaInicio); 	
	$fechaFin = Carbon::create($fechaFin);
	$hoy = Carbon::today();
?>
@include('inc.mensajeError')
<h3 class="mt-0 bg-info" style="text-align:center;border-radius: 25px;">
	<b>
		{{ $tituloHospedaje }}
	</b>
</h3>
<br>
<img align="center" width="400" height="300" style="border-radius: 25px;display:block; margin:auto;" src="/images/<?php echo $nombreImagen; ?>" alt="Generic placeholder image">
<br>
<hr>
<p>
	<b>Maximas personas hospedaje:</b> {{ $maximasPersonas }}
</p> 
<br>
<p>
	<b>Descripción hospedaje:</b> {{ $descripcion }}
</p>
<hr> 
<p>
	<b>Fecha inicio alojamiento:</b> {{ $fechaInicio->format('d-m-Y') }}
</p>  
<p>
	<b>Fecha fin alojamiento:</b> {{ $fechaFin->format('d-m-Y') }}
</p>
<hr>

<form class='form' method='post' action='/guardarhotsale'>
	{{ csrf_field() }}
	<div class="col-group col-md-12">
		<input type="hidden"   name="idSubasta" value="{{$idSubasta}}">
		<input type="text"  class="form-control col-md-6 col-group" name="precioBase" placeholder="Ingrese precio del Hotsale">
		<button class="col-md-4 col-group btn btn-success" type='submit'>
			Crear
		</button>
		<a style="margin-left: 40px" class="btn btn-secondary float-right btn-danger my-2 my-sm-0" href="{{ url('/candidatoshotsale') }}">Cancelar</a>
	</div>
</form>	