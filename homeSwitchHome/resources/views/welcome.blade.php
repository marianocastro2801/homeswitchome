@extends('layouts.baseapp')
@section('content')
<?php
use Illuminate\Support\Facades\DB;
?>

    <!--@_include('layouts.listarSubastas') CAUSA PROBLEMAS -->
    <div class="container bg-dark  text-white" style="margin-bottom: 55px; border-radius:25px; padding-bottom: 15px">
	    
        
      <div class="row colgroup">
	    	<div class="colgroup col-md-12">
				<h1 class="jumbotron display-4 text-center" style="border-style: double;"><img src="/images/Texto.png"></h1>
				<p class="lead my-3 font-italic" style="padding-right: 90px; padding-left: 90px; padding-bottom: 30px">	Una empresa dedicada unicamente a  ofrecete la oportunidad de tener tu alojamiento en un condominio dentro de desarrollos de alta calidad, los cuales son de una gama de amenidades en populares destinos vacacionales en toda la Argentina.</p>
			 <hr>
      </div>
    	<section class="search-sec" style="margin-left: 80px">
        <div class="container">
          <form action="/buscar">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label for="localidad" class="control-label">Localidad</label>
                    <select class="form-control" name="localidad" id="localidad">
                      <option value="">Seleccione</option>
                      @foreach($localidades as $localidad)
                        <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label for="fecha" class="control-label">Fecha de inicio alojamiento</label>
                    <input type="date" name="fechaInicioAlojamiento" class="form-control search-slt">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label for="tipoDeBusqueda" class="control-label">Tipo de Busqueda</label>
                    <select name="tipoBusqueda" class="form-control search-slt" id="exampleFormControlSelect1">
                      <option value="">Seleccione tipo</option>
                      <option value="Subasta">Subasta</option>
                      <option value="Hotsale">Hotsale</option>
                      <option value="Hospedaje">Hospedaje</option> <!-- si es admin, modificar despues-->
                    </select>
                  </div>
                  <div style="margin-top: 18px" class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <button type="submit" class="btn btn-danger btn-lg">Buscar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    @include('inc.mensajeError')
    @include('inc.mensajeExito')
		</div>
		  <div class="row mb-2">
        @foreach($subastas as $subasta)
        <?php 
              $hospedaje = DB::table('hospedajes')
                            ->where('id', $subasta->id_hospedaje)
                            ->first(); 
        ?>
        <div class="col-md-12">
          <div class="card flex-md-row mb-4 box-shadow h-md-250 bg-info" style="padding: 20px; margin: 20px; border-radius: 30px">
            <div class="card-body d-flex flex-column align-items-start" style="margin-left: 40px">
              <strong class="d-inline-block">Subasta</strong>
              
              <div class="colgroup" style="margin-left: -15px ;margin-bottom: -15px; margin-top: 5px">
                <div class="col-md-6 colgroup">
                  <span class="glyphicon glyphicon-log-in"></span> {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }} 
                </div>
                <div class="col-md-6 colgroup">
                  <span class="glyphicon glyphicon-log-out"></span> {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}
                </div>
              </div>
              
              <h1>
                <a class="text-dark" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}">{{ $hospedaje->titulo  }}</a>
              </h1>
              
              <p class="card-text mb-auto text-dark">Monto Base: ${{ $subasta->monto_base }}</p>
              <br>
              <p class="card-text mb-auto text-dark">  <span class="glyphicon glyphicon-map-marker">  </span>  <span class="glyphicon glyphicon-phone-alt">  </span>  <span class="glyphicon glyphicon-bed">  </span>  <span class=" glyphicon glyphicon-signal">  </span> </p>
              
              <a href="{{ url('/cargardetallesubasta/'.$subasta->id) }}" class="text-white">Ver detalle</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" style="border-radius: 25px" width="280" height="200" src="/images/{{ $hospedaje->imagen }}" alt="Card image cap">  
          </div>
        </div>
        @endforeach
      </div>
    </div>
	</div>

    @if(count($subastas) == 0)        
        <div class="container text-center bg-warning" style="border-radius: 25px; margin-bottom: 60px"><br><p><b>Mensaje de no hay ninguna subasta Que mostrar</b></p><br></div>
    @endif 

@endsection
