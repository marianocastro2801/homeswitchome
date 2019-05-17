@extends('layouts.baseapp')
@section('content')
	<div id="cent" class="text-center col-md-3 center">
		<form class="form-signin">
	  		<img class=" mb-4" src="/images/Logo.png" alt="" width="90" height="72">
	  		<h1 class="h3 mb-3 font-weight-normal">Por favor ingrese sus datos</h1>
	  		<label for="inputEmail" class="sr-only">Direccion email</label>
	  		<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	  		<br>
			<label for="inputPassword" class="sr-only">Contraseña</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
			<div class="checkbox mb-3">
			    <label>
			      <input type="checkbox" value="remember-me"> Recordarme
			    </label>
			 </div>
	  		<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
		</form>
	</div>
@endsection