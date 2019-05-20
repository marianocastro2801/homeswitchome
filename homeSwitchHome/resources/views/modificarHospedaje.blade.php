<?php 
use Illuminate\Support\Facades\DB;	
namespace App\Http\Controllers;
use Carbon\Carbon;
?>

<h1>Modificar:</h1>

<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
</div>


<form action="/validarModificacion" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}

<input type="text" name="titulo" value="{{ $tituloHospedaje }}">

<br>

<textarea class="form-control" name="descripcion" id="descripcion">{{ $descripcion }}</textarea>

<br>

<select class="form-control" name="cantidadPersonas" id="cantidadPersonas">
                  <option value="">Seleccione</option>
                  @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" 
                    @<?php if ($i == $maximasPersonas): ?>
                    	selected
                    <?php endif ?>>{{ $i }}</option>
                  @endfor
</select>

<br>

<label for="tipoHospedaje">Tipo hospedaje: </label>
                  <select class="form-control" name="tipoHospedaje" id="tipoHospedaje">
                  <option value="">Seleccione</option>
                  <option value="Casa" 
                  @<?php if ('Casa' == $tipoHospedaje): ?>
                    	selected
                  <?php endif ?>>Casa</option>
                  <option value='Hotel'
                  @<?php if ('Hotel' == $tipoHospedaje): ?>
                    	selected
                  <?php endif ?>>Hotel</option>
                  <option value="Duplex"
                  @<?php if ('Duplex' == $tipoHospedaje): ?>
                    	selected
                  <?php endif ?>>Duplex</option>
                  <option value="Cabaña"
                  @<?php if ('Cabaña' == $tipoHospedaje): ?>
                    	selected
                  <?php endif ?>>Cabaña</option>
                  <option value="Departamento"
                  @<?php if ('Departamento' == $tipoHospedaje): ?>
                    	selected
                  <?php endif ?>>Departamento</option>
                  <option value="Resort"
                  @<?php if ('Resort' == $tipoHospedaje): ?>
                    	selected
                  <?php endif ?>>Resort</option>
</select>

<br>

<select class="form-control" name="localidad" id="localidad">
                  <option value="">Seleccione</option>
                  @foreach($localidades as $localidad)
                    <option value="{{ $localidad->id }}"
                    @<?php if ($localidad->id == $idLocalidad): ?>
                    	selected
                  <?php endif ?>>{{ $localidad->nombre }}</option>
                  @endforeach
</select>

<br>

<input type="date" name="fechaInicio" value="{{ $fechaInicio }}">

<br>

<input type="date" name="fechaFin" value="{{ $fechaFin }}">

<br>

<input type="file" name="imagen">

<br>

<input type="hidden" name="idHospedaje" value="{{ $idHospedaje }}">

<button type="submit">Modificar</button>

</form>

@if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
@endif
