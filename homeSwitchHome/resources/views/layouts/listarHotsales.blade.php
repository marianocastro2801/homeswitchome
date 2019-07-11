@extends('layouts.baseapp')

@section('content')

@include('inc.mensajeError')
  <div class="container col-md-10" style="margin-top: 20px; margin-bottom: 50px">
           <h1 class="col-md-12 text-center bg-info" style=" margin-bottom: 30px;border-radius: 25px;border-style: double;"> Hotsales
           </h1>
    <div class="row">
      @if((count($hotsales)) == 0)
      	<div class="container text-center bg-warning" style="border-radius: 25px; margin-bottom: 60px"><br><p><b>No hay hotsales disponibles</p></b><br></div>
      @else
      		@foreach($hotsales as $hotsale)
        		<?php

        			//Podes listar todos los detalles que quieras porque no hay una historia que sea "ver detalles hotsale"
        			//Es lo mismo que en el listar subasta basicamente los datos que podes sacar

        			$hospedaje = DB::table('hospedajes')
        				->select('titulo', 'imagen' )
        				->where('id', $hotsale->id_hospedaje)
        				->first();
        		?>
            <div class="col-md-4">
              <div class="jumbotron" style="border-radius: 35px;">
                <div style="padding-top: 20px; padding-left: 20px">
                  <h3 class="text-center" style="margin-top: -30px">{{$hospedaje->titulo}}</h3>
                  <hr>
                  <img src="/images/{{ $hospedaje->imagen }}" width="280" height="190" style="display:block; margin:auto">
                  <hr>
                  <p><b>Fecha de ingreso:</b> {{ Carbon\Carbon::parse($hotsale->fecha_inicio)->format('d-m-Y') }} </p>
                  <p><b>Fecha de egreso:</b> {{ Carbon\Carbon::parse($hotsale->fecha_fin)->format('d-m-Y') }}</p>
                  <hr>
                  <p><b>Precio:</b> {{ '$'.$hotsale->precio_base }}</p>
                  @if( Session('nombreUsuario') != 'Andrea')
                    <form class='form' method='post' action='/reservarhotsale'>
                      {{ csrf_field() }}
                      <div class="col-group">
                        <input type="hidden"   name="idSubasta" value="{{ $hotsale->id_subasta }}">
                        <hr>
                        <button class="float-right col-group btn btn-success" type='submit'>
                          Reservar
                        </button>
                      </div>
                    </form>
                  @endif
                </div>
            </div>

            </div>


      		@endforeach
      @endif
    </div>
  </div>
@endsection
