@extends('layouts.baseapp')
@section('content')

<style type="text/css">
    .fondo{
        margin-top: 50; 
        padding: 25px;  
        border-bottom-left-radius:25px; 
        border-bottom-right-radius: 25px;
        background: black;
        margin-bottom: 60px;
    }    
</style>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="fondo  text-white">
                <h3 class="col-md-12 text-center">Datos Personales</h3>
                <hr style="background: white">
                <p>Nombre: {{ session('nombreUsuario') }} </p>
                <p>Apellido: {{ session('apellidoUsuario') }}</p>
                <p>Email: {{ session('email') }}</p>
                <p>Fecha De Nacimiento: {{ Carbon\Carbon::parse(session('fechaNacimiento'))->format('d-m-Y') }} </p>
                <p>Creditos: {{ session('creditos')}} </p>
                <hr style="background: white">
                @if(session('espremium'))
                    <p class="text-center" style="background: green; border-radius: 10px">Usted es un usuario premium</p>
                @else
                    <p class="text-center" style="background: red; border-radius: 10px">Usted aun no es usuario premium</p>
                @endif
                <hr style="background: white">
                <div class="btn-group row col-md-12">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <a href="/modificarcuenta" class="btn btn-primary">
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="fondo text-white">
                <h3 class="text-center"> Subastas incriptas e inicio de puja</h3>
                <hr style="background: white">
                    @if(count($subastas) == 0)  
                        <!--Si no hay publicacion-->
                        <div class="container text-center bg-warning" style="border-radius: 25px; margin-top: 80px"><br><p><b>Por el momento no participa de ninguna subasta</b></p><br></div>
                    @else 
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                  <th scope="col">Desde</th>
                                  <th scope="col">Hasta</th>
                                  <th scope="col">Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subastas as $subasta)
                                    <tr>
                                        <th scope="row">{{ Carbon\Carbon::parse($subasta->fecha_inicio_subasta)->format('d-m-Y') }} </th>
                                        <td>
                                           {{ Carbon\Carbon::parse($subasta->fecha_inicio_subasta)->format('d-m-Y') }}  
                                        </td>
                                        <td class="">
                                            <a class=" btn btn-info text-center" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}"> 
                                                Ir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
            </div>
        </div>
    </div>
</div>

@include('inc.mensajeExito')
@endsection