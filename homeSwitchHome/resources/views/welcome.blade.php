@extends('layouts.baseapp')
<<<<<<< HEAD
@section('content')
=======
	<p>{{ session('idUsuario') }}</p>
	<p>{{ session('nombreUsuario') }}</p>
	<p>{{ session('apellidoUsuario') }}</p>
	<p>{{ session('email') }}</p>
	<p>{{ session('esPremium') }}</p>
	<p>{{ session('numeroTarjeta') }}</p>
	<p>{{ session('fechaNacimiento') }}</p>


>>>>>>> origin/master
	<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
    </div>
<<<<<<< HEAD
@endsection
=======
@section('content')
@endsection
>>>>>>> origin/master
