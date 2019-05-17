<form action="/sesion/iniciar" method="post">
				{{ csrf_field() }}
				<input type="text" name="nombreUsuario" placeholder="Ingrese su nombre">
				<button type="submit">Iniciar</button>
</form>