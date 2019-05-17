<?php
  namespace App\Http\Controllers;

  use Carbon\Carbon;

?>  


<form action="/crearhospedaje/validar" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

<label for="titulo">Titulo: </label>
<input type="text" name="titulo" id="titulo" placeholder="Ingrese el titulo del hospedaje" >

<br>

<label for="descripcion" >Descripcion: </label>
<textarea name="descripcion" id="descripcion"  placeholder="Ingrese una descripción"></textarea>

<br>

<label for="cantidadPersonas">Cantidad de personas maximas: </label>
<select name="cantidadPersonas" id="cantidadPersonas">
<option value="">Seleccione</option>
@for($i = 1; $i <= 10; $i++)
<option value="{{ $i }}">{{ $i }}</option>
@endfor
</select>

<br>

<label for="tipoHospedaje">Tipo hospedaje: </label>
<select name="tipoHospedaje" id="tipoHospedaje">
<option value="">Seleccione</option>
<option value="casa">Casa</option>
<option value="hotel">Hotel</option>
<option value="duplex">Duplex</option>
<option value="resort">Resort</option>
</select>

<br>

<label for="localidad">Localidad: </label>
<select name="localidad" id="localidad">
<option value="">Seleccione</option>
@foreach($localidades as $localidad)
<option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
@endforeach
</select>

<br>

<p>Fechas en la que el hospedaje estará libre para crear subastas</p>

<label for="fechaInicio">Fecha inicial: </label>
<input type="date" name="fechaInicio" id="fechaInicio"  placeholder="Ingrese una descripción">

<br>

<label for="fechaInicio">Fecha final: </label>
<input type="date" name="fechaFin" id="fechaFin">

<br>              

<label for="imagen" > Imagen: </label>
<input name="imagen" id="imagen" type="file">

<br>

<button type="submit" class="btn btn-primary">Guardar</button>
<a class="btn btn-secondary my-2 my-sm-0" href="{{ url('/') }}">Cancelar</a>

<br>
<br>
<br>

@if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

</form>


<form action="/cerrarSubasta" method="post">
  {{ csrf_field() }}
  <button type="submit" class="btn btn-primary">Cerrar subasta</button>
  
</form>