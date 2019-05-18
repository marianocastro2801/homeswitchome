@extends('layouts.baseapp')
@section('content')
	<div id="cent" class="text-center col-md-3 center">
		<form class="form-signin" action="/sesion/iniciar" method="post">
			<h1 class="h3 mb-3 font-weight-normal">Por favor ingrese el nombre de usuario</h1>
			{{ csrf_field() }}
			<input type="text" name="nombreUsuario" class="text-center form-control">
			<br>
			<button type="submit" class="btn btn-lg btn-success btn-block">
				Iniciar
			</button>
		</form>
	</div>
@endsection