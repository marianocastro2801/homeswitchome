@extends('layouts.baseapp')
@section('content')

<?php
  use Illuminate\Support\Facades\DB;
?>

<style type="text/css">
  h3{
    margin-left: 20px;
    margin-top: 10px;
    text-align: center;
  }
</style>

<!--@_include('layouts.listarSubastas') CAUSA PROBLEMAS -->
<div class="container" style="margin-top: 10px">
  @include('inc.mensajeError')
  @include('inc.mensajeExito')
  <br>


  <!-- Cartel de Bienvenida-->
  <div class="bg-dark  text-white" style=" border-radius:25px; padding-bottom: 15px">
    <div class="row colgroup">
	   	<div class="colgroup col-md-12" style="margin-top: 20px">
				<h1 class="jumbotron display-4 text-center" style="border-style: double;"><img src="/images/Texto.png"></h1>
				<p class="lead my-3 font-italic" style="padding-right: 90px; padding-left: 90px; padding-bottom: 30px">	Una empresa dedicada unicamente a  ofrecete la oportunidad de tener tu alojamiento en un condominio dentro de desarrollos de alta calidad, los cuales son de una gama de amenidades en populares destinos vacacionales en toda la Argentina.</p>
      </div>
		</div>
  </div>

  <!--Carrusel -->
      @if(count($subastas) == 0)
        <div class="container text-center bg-warning" style="border-radius: 25px; margin-top: 20px ;margin-bottom: 60px"><br><p><b>No hay subastas en este momento. Intente mas tarde</b></p><br></div>

      @else
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-left: 80px; margin-right: 80px">

        @foreach($subastas as $subasta)
          <ol class="carousel-indicators">
          @if($loop->first)
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          @endif

            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration }}"></li>

          </ol>
        @endforeach
            <div class="carousel-inner">
                @foreach($subastas as $subasta)
                <?php
                      $hospedaje = DB::table('hospedajes')
                                    ->where('id', $subasta->id_hospedaje)
                                    ->first();
                ?>
                @if($loop->first)
                <div class="carousel-item active">
                  <img class="d-block w-100" src="/images/{{ $hospedaje->imagen }}" height="570" alt="First slide" style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px; ">
                  <div class="carousel-caption d-none d-md-block">
                    <h1 style="color: black; border-color: black; margin-top: -510px">
                      <a class="text-dark" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}">
                        {{ $hospedaje->titulo  }}
                      </a>
                    </h1>
                    <p class="card-text mb-auto text-dark">Monto Base: ${{ $subasta->monto_base }}</p>
                  </div>
                </div>
                @else
                  <div class="carousel-item">
                  <img class="d-block w-100" src="/images/{{ $hospedaje->imagen }}" height="570" style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px; " >
                  <div class="carousel-caption d-none d-md-block">
                    <h1 style="color: black; border-color: black; margin-top: -510px">
                      <a class="text-dark" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}">
                        {{ $hospedaje->titulo  }}
                      </a>
                    </h1>
                    <p class="card-text mb-auto text-dark">Monto Base: ${{ $subasta->monto_base }}</p>
                  </div>
                </div>
                @endif
              @endforeach
            </div>

          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        @endif

        <!-- Buscador -->
        <div class="bg-info" style="margin-top:-20px ; border-radius: 20px; margin-left: 100px; margin-right: 100px">
        <section class="search-sec" style=" padding: 30px;">
        <div class="container">
          <form method="post" action="/" >
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label>Localidad</label>
                    <select class="form-control" name="localidad" id="localidad">
                      <option value="">Localidad</option>
                        @foreach($localidades as $localidad)
                          <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label>Desde</label>
                    <input type="date" name="fechaInicioAlojamiento" class="form-control search-slt">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label>Hasta</label>
                    <input type="date" name="fechaFinAlojamiento" class="form-control search-slt">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <label>Tipo de Busqueda</label>
                    <select name="tipoBusqueda" class="form-control search-slt" id="exampleFormControlSelect1">
                      <option value="">Tipo de Busqueda</option>
                      <option value="Subasta">Subasta</option>
                      <option value="Hotsale">Hotsale</option>
                    </select>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 p-0" style="text-align: center; margin-top: 10px">
                    <button type="search" id="btnbuscar" class="btn btn-danger btn-lg" >Buscar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
  </div>
	<div>
    <!-- Resultado de buscador-->
    <div class=" text-center row" >
      <div class="col-md-2">

      </div>
      @if(!$vacio)
        <div class="col-md-8" id="buscador">
          @if(count($resultadosDeBusqueda) == 0)
            <div> No se encontraron resultados </div>
          @else
          <table class="table table-striped table-dark" style="text-align: center; border-bottom-right-radius:25px; border-bottom-left-radius: 25px">
            <thead>
              <tr>
                  <th scope="col">Imagen</th>
                  <th scope="col">Titulo</th>
                  <th scope="col">Ciudad</th>
                  <th scope="col">Detalle</th>
                </tr>
            </thead>
            <tbody>
            @foreach($resultadosDeBusqueda as $subasta)
            <?php
                $hospedaje = DB::table('hospedajes')
                    ->where('id', $subasta->id_hospedaje)
                    ->first();
                $localidades = DB::table('localidads')
                    ->where('id', $hospedaje->id_localidad)
                    ->first();
            ?>
            <tr>
              <th scope="row">
                <img src="/images/{{ $hospedaje->imagen }}" height="110" width="160">
              </th>
              <td>
                <br>
                {{ $hospedaje->titulo }}
              </td>
              <td>
                <br>
                {{ $localidades->nombre }}
              </td>
              <td>
                <br>
                <a class="btn btn-info float-right" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}">
                    Ver
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
          @endif
        </div>
      @endif
      <div class="col-md-2">

      </div>
    </div>
    <br>
    <br>
    <br>
  </div>

</div>

@endsection
<!--
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
	</div>

    @if(count($subastas) == 0)
        <div class="container text-center bg-warning" style="border-radius: 25px; margin-bottom: 60px"><br><p><b>Mensaje de no hay ninguna subasta Que mostrar</b></p><br></div>
    @endif
-->
