<?php
  namespace App\Http\Controllers;

  use Carbon\Carbon;

?>  

@extends('layouts.baseapp')
@section('content')
<div class="container">
  <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="panel panel-primary" style="margin-bottom: 55px">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Crear Hospedaje</h3>
        </div>
        <div class="panel-body" style="background: #f3f3f3"> 
          <form action="/crearhospedaje/validar" method="post" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                {{ csrf_field() }}
                <label for="titulo">Titulo: </label>
                <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Ingrese el titulo del hospedaje" >
              </div>
              <br>
                <br>
                <div class="form-group col-md-6">
                <label for="cantidadPersonas">Cantidad de personas maximas: </label>
                <select class="form-control" name="cantidadPersonas" id="cantidadPersonas">
                  <option value="">Seleccione</option>
                  @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>  
                <br>
                <br>
                <div class="form-group col-md-12">
                <label for="descripcion" >Descripcion: </label>
                <textarea class="form-control" name="descripcion" id="descripcion"  placeholder="Ingrese una descripción"></textarea>
              </div>
                <br>
                <br>
                <div class="form-group col-md-6">
                <label for="tipoHospedaje">Tipo hospedaje: </label>
                  <select class="form-control" name="tipoHospedaje" id="tipoHospedaje">
                  <option value="">Seleccione</option>
                  <option value="Casa">Casa</option>
                  <option value="Hotel">Hotel</option>
                  <option value="Cabaña">Cabaña</option>
                  <option value="Departamento">Departamento</option>
                  <option value="Duplex">Duplex</option>
                  <option value="Resort">Resort</option>
                </select>
              </div>
                <br>
                <br>
                <div class="form-group col-md-6">
                <label for="localidad">Localidad: </label>
                <select class="form-control" name="localidad" id="localidad">
                  <option value="">Seleccione</option>
                  @foreach($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                  @endforeach
                </select>
              </div>
                <br>
                <br>
                <div class="form-group col-md-6">
                <label for="fechaInicio">Fecha inicial: </label>
                <input class="form-control" type="date" name="fechaInicio" id="fechaInicio"  placeholder="Ingrese una descripción">
              </div>
                <br>
                <br>
                <div class="form-group col-md-6">
                <label for="fechaInicio">Fecha final: </label>
                <input class="form-control" type="date" name="fechaFin" id="fechaFin">
              </div>
                <br>
                <br>
                <div class="form-group col-md-12">              
                <label for="imagen" > Imagen: </label>
                <input name="imagen" class="float-right" id="imagen" type="file">
              </div>
                <br>
                <br>
              </div>
              
                <button type="submit" class="float-left btn btn-primary">Guardar</button>
                <a class="btn btn-secondary float-right btn-danger my-2 my-sm-0" href="{{ url('/') }}">Cancelar</a>
              
          </div>
            </form>
          
        </div>
      </div>
    </div>
  </div>
</div>
      
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

@endsection