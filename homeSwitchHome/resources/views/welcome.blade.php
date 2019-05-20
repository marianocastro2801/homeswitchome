@extends('layouts.baseapp')
@section('content')

	<p>{{ session('idUsuario') }}</p>
	<p>{{ session('nombreUsuario') }}</p>
	<p>{{ session('apellidoUsuario') }}</p>
	<p>{{ session('email') }}</p>
	<p>{{ session('esPremium') }}</p>
	<p>{{ session('numeroTarjeta') }}</p>
	<p>{{ session('fechaNacimiento') }}</p>


	<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
    </div>

    @include('layouts.listarSubastas')

@endsection
