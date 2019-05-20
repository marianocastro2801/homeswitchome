<?php 
use Illuminate\Support\Facades\DB;	
namespace App\Http\Controllers;
use Carbon\Carbon;
?>

<h1>Hospedaje:</h1>

<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
</div>

<p>Titulo: {{ $tituloHospedaje }} </p>

<p>Descripcion: {{ $descripcion }} </p>

<p>Cantidad de personas maximas: {{ $maximasPersonas }} </p>

<p>Tipo hospedaje: {{ $tipoHospedaje }} </p>

<p>Localidad: {{ $localidad }} </p>   

<p> Imagen: </p>

<img src="/images/{{ $nombreImagen }}">

<p>Fecha inicio: {{ $fechaInicio }} </p>   

<p>Fecha fin: {{ $fechaFin }} </p>   

<a href="{{ url('/modificarHospedaje/'.$idHospedaje) }}"> Modificar hospedaje</a>

<form action="/eliminarHospedaje" method="post">
	{{ csrf_field() }}
	<button >Eliminar hospedaje</button>
	<input type="hidden" name="idHospedaje" value="{{ $idHospedaje }}">

</form>

