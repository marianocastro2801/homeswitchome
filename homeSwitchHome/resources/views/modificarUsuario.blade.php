<form action="/modificarcuenta/datos" method="post">
	{{ csrf_field() }}
	<p>Correo</p>
	<input type="text" name="email" value="{{old('email', session('email'))}}">
	<br>
	<p>Nombre</p>
	<input type="text" name="nombreUsuario" value="{{old('nombreUsuario', session('nombreUsuario'))}}">
	<br>
	<p>Apellido</p>
	<input type="text" name="apellidoUsuario" value="{{old('apellidoUsuario', session('apellidoUsuario'))}}">
	<br>
	<p>Fecha de nacimiento</p>
	<input type="date" name="fechaNacimiento" value="{{old('fechaNacimiento', session('fechaNacimiento'))}}">
	<br>
	<p>Numero de tarjeta</p>
	<input type="text" name="numeroTarjeta" value="{{old('numeroTarjeta', session('numeroTarjeta'))}}">
	<br>
	<p>Mes vencimiento</p>
	<input type="text" name="mesVencimiento" value="{{old('mesVencimiento', session('mesVencimiento'))}}">
	<br>
	<p>Año vencimiento</p>
	<input type="text" name="anioVencimiento" value="{{old('anioVencimiento', session('anioVencimiento'))}}">
	<br>
	<p>Código seguridad</p>
	<input type="text" name="codigoSeguridad" value="{{old('codigoSeguridad', session('codigoSeguridad'))}}">
	<br>
	<button type="submit">Guardar</button>
	<br>
	<a href="/perfil">Cancelar</a>
</form>
<form action="/modificarcuenta/contrasenia" method="post">
	{{ csrf_field() }}	
	<hr>
	<p>Contraseña anterior</p>
	<input type="password" name="contraseniaVieja">
	<br>
	<p>Nueva contraseña</p>
	<input type="password" name="contraseniaNueva">
	<br>
	<p>Confirmar nueva contraseña</p>
	<input type="password" name="contraseniaNueva_confirmation">
	<br>
	<button type="submit">Guardar</button>
	<br>
	<a href="/perfil">Cancelar</a>
</form>

@include('inc.mensajeError')