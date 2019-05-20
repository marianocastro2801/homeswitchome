<?php 
use Illuminate\Support\Facades\DB;

?>




<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
</div>
@extends('layouts.baseapp')

@section('content')
<div class="containes col-md-12" style="margin-bottom: 50px">
         <h1 class="col-md-12 text-center bg-info" style=" margin-bottom: 30px"> Hospedajes </h1>

        
           
        
            @foreach($hospedajes as $hospedaje)
                <div class="col-md-4" style="margin-bottom: 30px">
                    <div class="card  text-white bg-dark">
                        
                            <img src="/images/{{ $hospedaje->imagen }}" width="380" height="300" ></li>  
                        
                        <div class="card-body">
                            <h5 class="card-title">
                        	    
                                    Titulo: {{ $hospedaje->titulo }}
                                
                            </h5>
                        
                                <p class="card-text">
                                    Tipo: {{ $hospedaje->tipo_hospedaje }}
                                </p>
                            
                        	
                                <p class="card-text">
                                    Cantidad de personas: {{ $hospedaje->cantidad_maxima_personas }}
                                </p>
                                	
                        
                            <a class="btn btn-info" href="{{ url('/cargardetallehospedaje/'.$hospedaje->id) }}"> 
                                    Ver detalles Hospedaje
                            </a>
                        </div>
                    </div>
            	</div>

            @endforeach	
        </ul>
    </div>
</div>
@endsection