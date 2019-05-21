@extends('layouts.baseapp')
@section('content')

	<!--
		<p>{{ session('idUsuario') }}</p>
		<p>{{ session('nombreUsuario') }}</p>
		<p>{{ session('apellidoUsuario') }}</p>
		<p>{{ session('email') }}</p>
		<p>{{ session('esPremium') }}</p>
		<p>{{ session('numeroTarjeta') }}</p>
		<p>{{ session('fechaNacimiento') }}</p>
	-->

	<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
    </div>

    <!--@_include('layouts.listarSubastas') CAUSA PROBLEMAS -->
    <div class="container bg-dark" style="margin-bottom: 55px; border-radius:25px">
	    <div class="row colgroup">
	    	<div class="colgroup col-md-8">
				<h1 class="jumbotron display-4 font-italic text-dark text-center bg-info" style="border-style: double;"><FONT SIZE=7>Bienvenido HomeSWITCHHome</FONT></h1>
				<p class="lead my-3 text-white" style="padding-right: 90px; padding-left: 20px;">	Una pagina web dedicada unicamente a  ofrecete la oportunidad de tener tu alojamiento en un condominio dentro de desarrollos de alta calidad, los cuales son de una gama de amenidades en populares destinos vacacionales en toda la Argentina.</p>
			</div>
			<div class="colgroup col-md-4">
				<div class="jumbotron  p-3 p-md-5 text-dark rounded" style="background: #FDF4E3; height: 370px;margin-top: 20px;">
				  	<h6 class="display-4 font-italic text-center"> CONTACTOS</h6>
				  	<br>
				  	<p class="lead my-3 text-center">TEL 221-4388900</p>
				    <p class="lead my-3 text-center"> TEL 221-4390022</p>
				    <p class="lead my-3 text-center">homeswitchhome@info.com</p>
				    <p class="lead my-3 text-center">andreaperez@gmail.com</p>
				</div>
			</div>
		</div>
		  <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250 bg-info">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block">Subastas</strong>
              <h3>
                <a class="text-dark" href="{{ url('/cargardetallesubasta/'.$idSubasta1) }}">{{ $tituloHospedaje1  }}</a>
              </h3>
              <div class="mb-1 text-muted">{{ $fechaInicio1 }}</div>
              <p class="card-text mb-auto text-dark">Monto Base: ${{ $montoBase1 }}</p>
              <a href="{{ url('/cargardetallesubasta/'.$idSubasta1) }}" class="text-warning">Ver detalle</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" width="280" height="200" src="/images/{{ $nombreImagen1 }}" alt="Card image cap">  
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250 bg-info">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block">Subastas</strong>
              <h3>
                <a class="text-dark" href="{{ url('/cargardetallesubasta/'.$idSubasta2) }}">{{ $tituloHospedaje2  }}</a>
              </h3>
              <div class="mb-1 text-muted">{{ $fechaInicio2 }}</div>
              <p class="card-text mb-auto text-dark">Monto Base: ${{ $montoBase2 }}</p>
              <a href="{{ url('/cargardetallesubasta/'.$idSubasta2) }}" class="text-warning">Ver detalle</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" width="280" height="200" src="/images/{{ $nombreImagen2 }}" alt="Card image cap">
          </div>
        </div>
      </div>
    </div>
	</div>


@endsection
