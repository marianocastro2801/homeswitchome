<?php 
use Illuminate\Support\Facades\DB;

?>


<h1> Hospedajes: </h1>

<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
</div>



<ul>
@foreach($hospedajes as $hospedaje)
	<li>Titulo: {{ $hospedaje->titulo }}</li>
	<li>Tipo: {{ $hospedaje->tipo_hospedaje }}</li>
	<li>Cantidad de personas: {{ $hospedaje->cantidad_maxima_personas }}</li>
	
	<li><img src="/images/{{ $hospedaje->imagen }}"></li>  
	
    </li>
          <a href="{{ url('/cargardetallehospedaje/'.$hospedaje->id) }}"> Ver detalles Hospedaje</a>
    <br>
    <br>
	
    
@endforeach	
</ul>