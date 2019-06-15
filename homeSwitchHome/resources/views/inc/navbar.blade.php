<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-static-top container-fluid navbar-dark bg-dark">


  <!-- Navbar brand -->
  <a class="navbar-brand" href="/">
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
            <a class="nav-link" href="/listarhospedajes">Ver Hospedajes</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/crearhospedaje">Crear Hospedajes</a>
          </li>
        @endif
      </ul>


      <!-- Notifications -->

    </div>
      <div class="row" style="margin-right: 15px; float:right" >
        <div class="btn-group" style="margin-right: 50px">
          @if(session('esPremium'))
            <a href="#" class="btn btn-info btn-lg">
            <span>Usted ya es premium</span>
            @else
              @if($solicitud)
                <a href="#" class="btn btn-info btn-lg">
                <span>Usted ya solicitó premium</span>
              @else
                <a href="/informacion" class="btn btn-info btn-lg">
                <span>Solicitar premium</span> 
              @endif
            @endif  
          </a>
          <div class="dropdown-menu" >
             <a class="dropdown-item" href="#"><span class="  glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 1(Despues sacar esto)</a>
            <a class="dropdown-item" href="#"><span class=" glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 2</a>
            
            <a class="dropdown-item" href="#"><span class="  glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 3</a>
              <a class="dropdown-item" href="#"><span class=" glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 4</a>
          </div>
        </div>
      <div class="row" style="margin-right: 15px; float:right" >
        <div class="btn-group" style="margin-right: 50px">
          <a href="#" class="dropdown-toggle dropdown-toggle-split btn btn-info btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-bell"></span>
          </a>
          <div class="dropdown-menu" >
             <a class="dropdown-item" href="#"><span class="  glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 1(Despues sacar esto)</a>
            <a class="dropdown-item" href="#"><span class=" glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 2</a>
            
            <a class="dropdown-item" href="#"><span class="  glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 3</a>
              <a class="dropdown-item" href="#"><span class=" glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 4</a>
          </div>
        </div>
      </div>

      <!-- Info user -->
      <div class="btn-group" >
            <button class="btn btn-info btn-lg" type="button">
              {{ session('nombreUsuario') }}
              {{ session('apellidoUsuario') }}
            </button>
            <button type="button" class="btn btn-lg btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            
            <div class="dropdown-menu" >
              <a class="dropdown-item" href="/perfil"><span class="glyphicon glyphicon-user" style="margin-right: 10px"></span>Mi Perfil</a>
              <a class="dropdown-item" href="#"><span class="glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Contactos</a>
              <a class="dropdown-item" href="#"><span class="glyphicon glyphicon-question-sign" style="margin-right: 10px"></span>FAQ</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/login"><span class="glyphicon glyphicon-off" style="margin-right: 10px"></span>Cerrar sesion</a>
            </div>
        </div>
    </div>
  @endif
</nav>
<!--/.Navbar-->