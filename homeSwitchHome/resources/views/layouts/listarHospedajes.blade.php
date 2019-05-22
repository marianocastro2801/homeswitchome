<?php 
use Illuminate\Support\Facades\DB;

?>


@extends('layouts.baseapp')

@section('content')

<div class="containes col-md-12" style="margin-bottom: 50px">
         <h1 class="col-md-12 text-center bg-info" style=" margin-bottom: 30px;border-radius: 25px;border-style: double;"> Hospedajes </h1>

            
            
                    @if(session('exito'))
                    <div class="col-md-12">            
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            {{ session('exito') }}
                        </div>
                    </div>
                    @endif
            
           
        
            @foreach($hospedajes as $hospedaje)
                <div class="col-md-4" style="margin-bottom: 30px;">
                    <div class="card  text-white bg-dark" style="border-radius: 25px;">
                        
                            <img src="/images/{{ $hospedaje->imagen }}" style="border-radius: 25px;margin: 15px" width="350" height="270"  ></li>  
                        <hr/>
                        <div class="card-body" style="margin-left: 20px">
                            <h5 class="card-title">
                        	    
                                    Titulo: {{ $hospedaje->titulo }}
                                
                            </h5>
                        
                                <p class="card-text">
                                    Tipo: {{ $hospedaje->tipo_hospedaje }}
                                </p>
                            
                        	
                                <p class="card-text">
                                    Cantidad de personas: {{ $hospedaje->cantidad_maxima_personas }}
                                </p>
                                	
                        
                            <a class="btn btn-info float-right" href="{{ url('/cargardetallehospedaje/'.$hospedaje->id) }}"> 
                                    <span class="glyphicon glyphicon-share-alt"></span> Ver detalles Hospedaje
                            </a>
                        </div>
                    </div>
            	</div>

            @endforeach	
        </ul>
    </div>
</div>
@endsection