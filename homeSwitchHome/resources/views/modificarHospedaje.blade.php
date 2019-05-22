<?php 
use Illuminate\Support\Facades\DB;	
namespace App\Http\Controllers;
use Carbon\Carbon;
?>

@extends('layouts.baseapp')

@section('content')
<div class="conteiner col-md-12" style="margin-bottom: 50px">
  <div>
          @include('inc.mensajeError')
  </div>
  <h1 class="col-md-12 text-center bg-info" style="border-radius: 25px;border-style: double; margin-bottom: 30px"> Modificar </h1>
  
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="card" style="background: #c6c6c6;border-radius: 25px;border-style: double;"  > 
      <form action="/validarModificacion" style="margin: 30px" method="post" enctype="multipart/form-data">
            	{{ csrf_field() }}
              <p><b>Titulo</b></p>
            <input type="text" class="form-control" name="titulo" value="{{ $tituloHospedaje }}">
            <br>
            <p><b>Descripcion</b></p>
            <textarea class="form-control" style="width:730px;height:100px;" name="descripcion" id="descripcion">{{ $descripcion }}</textarea>
            <br>
            <p><b>Capacidad maxima</b></p>

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

            <label for="tipoHospedaje">Tipo hospedaje </label>
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

            <p><b>Localidad</b></p>
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
            <p><b>Fecha Inicio</b></p>
            <input type="date"  class="form-control" style="margin-bottom: 15px" name="fechaInicio" value="{{ $fechaInicio }}">

            <br>
            <p><b>Fecha Fin</b></p>
            <input type="date"  class="form-control" name="fechaFin" style="margin-bottom: 15px" value="{{ $fechaFin }}">

            <br>

            <input type="file" style="margin-bottom: 15px" name="imagen">

            <br>

            <input type="hidden" name="idHospedaje" value="{{ $idHospedaje }}">
  
            <a style="margin-left: 40px" class="btn btn-secondary float-right btn-danger my-2 my-sm-0" href="{{ url('/listarhospedajes') }}">Cancelar</a>

            <button type="submit" class="float-right btn btn-success">Modificar</button>


      </form>

      
    </div>
  </div>
</div>
@endsection
