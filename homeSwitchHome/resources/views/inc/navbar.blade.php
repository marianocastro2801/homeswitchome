<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-static-top container-fluid navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" @if(!(Request::is('login')) && !(Request::is('registrar')))
                                {{ 'href=/' }}
                               @else
                                {{ 'href=/login' }}
                               @endif>
    <ul class="nav navbar-nav list-inline">
      <li class="list-inline-item">
        <img src="/images/Logo.png" width="40" height="35">
      </li class="list-inline-item">
      <li>
        <img src="/images/Texto.png" width="230" height="22" style="margin-top: 4px">
      </li>
    </ul>
  </a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
      class="navbar-toggler-icon"></span></button>

       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
      class="navbar-toggler-icon"></span></button>
 @if(!(Request::is('login')) && !(Request::is('registrar')))
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Links -->
      <ul class="navbar-nav mr-auto"  style="margin-top: 10px">
          <!--      <li class="nav-item">
                  <a class="nav-link itemnav" href="#">Localidades<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item itemnav">
                  <a class="nav-link" href="#">HotSale</a>
                </li>-->

        @if (Session('nombreUsuario') == 'Andrea')
          <li class="nav-item ">
            <a class="nav-link" href="/crearhospedaje" style="margin-left: 30px;">Crear Hospedajes</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/listarhospedajes" style="margin-left: 30px;">Ver Hospedajes</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/candidatoshotsale" style="margin-left: 30px;">Ver Candidatos</a>
          </li>
        @endif
        <li class="nav-item">
            <a class="nav-link itemnav" href="/listarsubastas" style="margin-left: 30px;">Ver Subastas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link itemnav" href="/listarhotsales" style="margin-left: 30px;">Ver Hotsale</a>
        </li>
      </ul>
    </div>



      <!-- Notifications -->
    <div class="row" style="margin-right: 10px; float:right" >
      @if(Session('nombreUsuario') != 'Andrea')
        <div class="btn-group dropleft" style="margin-right: 20px">
          <a href="#" class="dropdown-toggle dropdown-toggle-split btn btn-info btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="/images/noti.png" width="30px" height="30px">
          </a>
          <div class="dropdown-menu" >
            <a class="dropdown-item text-center" href="#">Area de notificaciones</a>
            <hr>
            @if(count(session('mensajes')) == 0)
              <a class="dropdown-item" href="#">No posee notificaciones</a>
            @else
              @foreach(session('mensajes') as $mensaje)
                <a class="dropdown-item" href="#"><small><small><small><b>- {{ $mensaje }}</b></small></small></small></a>
              @endforeach
            @endif
          </div>
        </div>
      @endif


      <!-- botones -->
        <div class="btn-group" id="buttons" style="margin-right: 20px">
          @if(Session('nombreUsuario') == 'Andrea')
          <a href="#" class="btn btn-warning btn-lg">
          <span id="premium">Usuario Administrador</span>
          @else
              @if(session('esPremium'))
                <a href="#" class="btn btn-warning btn-lg">
                  <span id="premium">Usted es premium</span>
                </a>
              @else
                @if(session('solicitud'))
                  <button type="button" id="solicitud" class="btn btn-primary text-white btn-lg">
                  Solicitud premium enviada</button>
                @else
                  <!-- Button trigger modal -->
                   <button type="button" id="solicitar" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal">
                   Solicitar Premium
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Solicitud Enviada</h5>
                          <a style="text-decoration: none" class="" href="/boton">
                             <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                        <div class="modal-body">
                          <p>
                            Presentar en Calle 50 &, Av. 120, La Plata, Buenos Aires de Lunes a Viernes de 8 a 12 para que pueda hacerce efectivo su cambio a usuario premium
                          </p>
                        </div>
                        <div class="modal-footer">
                          <a class="btn btn-secondary" style="text-decoration: none" href="/boton"> Aceptar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endif
            @endif
          </a>

        </div>



        <!-- Info user -->
          <div class="btn-group" >
            <button class="btn btn-info btn-md" type="button">
              {{ session('nombreUsuario') }}
              {{ session('apellidoUsuario') }}
            </button>
            <button type="button" class="btn btn-lg btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>

            <div class="dropdown-menu" >
              @if(Session('nombreUsuario') == 'Andrea')
                <a class="dropdown-item" href="/perfilAdministrador">Usuarios</a>
              @else
                <a class="dropdown-item" href="/perfil">Mi Perfil</a>
              @endif
              @if(Session('nombreUsuario') != 'Andrea')
                <a href="#contacots" class="dropdown-item" data-toggle="modal" data-target="#contactos">Contactos</a>
                <a href="#response" class="dropdown-item" data-toggle="modal" data-target="#response">FAQ</a>
              @endif
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/login">Cerrar sesion</a>
            </div>
            <div class="modal" id="response">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Preguntas Frecuentes</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="list-group">
                      <div class="d-flex w-100 justify-content-between">
                        <div class="">
                          <h6>1- ¿Qué acciones podrá realizar cada uno de los usuarios?</h6>
                          <p>Un usuario normal podrá ver distintas residencias, anotarse a subastas, ofertar en las subasta, reservar por hotsale, ver su perfil con estados de subastas y reservas.
                            El usuario premium podrá hacer lo mismo, con la diferencia que se le cobra un monto de registro y un extra mensual. Y como beneficio podrá acceder directamente a la propiedad sin pasar por la etapa de inscripción a la subasta.
                            En la etapa subastas ambos usuarios tienen los mismos “privilegios”.</p>
                          <h6>2- ¿Un mismo usuario puede hacer a múltiples reservas?</h6>
                          <p>Si, pero se maneja mediante un sistema de créditos. Este crédito será adquirido a cada usuario una vez se registren. El usuario recibirá la suma de dos créditos cada 1 año, y se descontará uno al reservar un hospedaje, ya sea por ganar una subasta, reservar un Hotsale o reservar directo siendo usuario Premium.
                            Se tiene pensado que haya un mecanismo de comprar créditos, pero no será implementado por el momento.</p>
                            <h6>3- ¿Qué sucede con los usuarios que no tengan suficiente saldo para pagar la cuota mensual?</h6>
                            <p>Se le informa que no tienen suficiente crédito como para usar el sistema y se le da la opción de cambiar de tarjeta.</p>
                            <h6>4- ¿Cuál es la demografía y alcance que apuntan?</h6>
                            <p>Personas mayores de 18 años en América.</p>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal" id="contactos">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Contacto</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                        <div class="container-fluid">
                          <div class="d-flex w-100 justify-content-between">
                              <div class="row">
                                <div class="col-md-12">
                                  <p><b>Direccion:</b> Calle 50 &, Av. 120, La Plata, Buenos Aires de Lunes a Viernes de 8 a 12.</p>
                                  <p><b>Email:</b> andreaperez@gmail.com</p>
                                  <p><b>Tel:</b> 221 - 4567434</p>
                                </div>
                              </div>
                            </div>
                          </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  @endif
</nav>
<!--/.Navbar-->
