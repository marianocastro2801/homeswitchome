<?php
    use Illuminate\Support\Facades\DB;
?>
@extends('layouts.baseapp')
@section('content')

<style type="text/css">
    .fondo{
        margin-top: 50;
        padding: 25px;
        border-bottom-left-radius:25px;
        border-bottom-right-radius: 25px;
        background: black;
        margin-bottom: 30px;
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
                <p>Fecha de nacimiento: {{ Carbon\Carbon::parse(session('fechaNacimiento'))->format('d-m-Y') }} </p>
                <p>Creditos: {{ session('creditos')}} </p>
                <hr style="background: white">
                @if(session('esPremium'))
                    <p class="text-center bg-info" style=" border-radius: 10px">Usted es un usuario premium</p>
                @else
                    <p class="text-center bg-danger" style=" border-radius: 10px">Usted aun no es usuario premium</p>
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



        <!--Subastas inscriptas-->
        <div class="col-md-6">
          @if(!session('esPremium'))
            <div class="fondo text-white">
                <h3 class="text-center">Subastas en las que participa</h3>
                <hr style="background: white">
                    @if(count($subastas) == 0)
                        <!--Si no hay publicacion-->
                        <div class="container text-center bg-info" style="border-radius: 25px; margin-top: 20px"><br><p><b>Por el momento no participa de ninguna subasta</b></p><br>
                            <a href="listarsubastas" style="text-decoration: none"><button class="btn btn-dark" style="margin-bottom: 20px">Ver Subastas</button></a>
                        </div>
                    @else
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                  <th scope="col" style="text-align: center">Titulo</th>
                                  <th scope="col" style="text-align: center">Comienzo subasta</th>
                                  <th scope="col" style="padding: 12px 20px 12px 20px;text-align: center">Fin subasta</th>
                                  <th scope="col" style="text-align: center">Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subastas as $subasta)
                                    <?php
                                        $hospedaje = DB::table('hospedajes')
                                                    ->where('id', $subasta->id_hospedaje)
                                                    ->first();
                                    ?>
                                    <tr>
                                        <td style="text-align: center">
                                            {{ $hospedaje->titulo }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ Carbon\Carbon::parse($subasta->fecha_inicio_subasta)->format('d-m-Y') }}
                                        </td style="text-align: center">
                                        <td>
                                           {{ Carbon\Carbon::parse($subasta->fecha_fin_subasta)->format('d-m-Y') }}
                                        </td>
                                        <td>
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
            @endif
            <div style="border-radius: 25px; margin-top:20px" class="fondo text-white">
              <h3 class="text-center">Mis reservas</h3>
              <hr style="background-color:#fff">
              @if(count($misReservas) == 0)
                <div class="container text-center bg-info" style="border-radius: 25px; margin-top: 20px"><br><p><b>Por el momento no tiene reservas hechas</b></p><br></div>
              @else
              <table class="table table-striped table-dark">
                  <thead>
                      <tr>
                        <th scope="col" style="text-align: center">Titulo</th>
                        <th scope="col" style="text-align: center">Ingreso a Hospedaje</th>
                        <th scope="col" style="padding: 12px 20px 12px 20px;text-align: center">Egreso del Hospedaje</th>
                        <!--<th scope="col" style="text-align: center">Detalle</th>-->
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($misReservas as $reserva)
                      <?php
                          $subasta = DB::table('subastas')
                                      ->where('id', $reserva->id_subasta)
                                      ->first();
                          $hospedaje = DB::table('hospedajes')
                                      ->where('id', $subasta->id_hospedaje)
                                      ->first();
                      ?>
                      <tr>
                          <td style="text-align: center">
                              {{ $hospedaje->titulo }}
                          </td>
                          <td style="text-align: center">
                              {{ Carbon\Carbon::parse($subasta->fecha_inicio)->format('d-m-Y') }}
                          </td style="text-align: center">
                          <td>
                             {{ Carbon\Carbon::parse($subasta->fecha_fin)->format('d-m-Y') }}
                          </td>
                          <!--<td>
                              <a class=" btn btn-info text-center" href="{{ url('/cargardetallesubasta/'.$subasta->id) }}">
                                  Ir
                              </a>
                          </td>-->
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
