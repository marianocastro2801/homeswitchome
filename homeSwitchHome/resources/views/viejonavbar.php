<style type="text/css">
  .itemnav{
    margin-left: 15px;
    margin-right: 15px;
  }
  li{
    list-style: none;
  }
</style>

<nav class="navbar navbar-expand-sm navbar-static-top navbar-dark bg-dark" >
  <a class="navbar-brand" href="/">
    <ul class="list-inline">
      <li>  
        <img src="/images/Logo.png" width="40" height="30" class="d-inline-block align-top">
      </li>
      <li>
        <img src="/images/Texto.png" width="220" height="25" style="margin-left: -35px; margin-top: 4px"></a>
      </li>
    </ul>
   @if(!(Request::is('sesion')))
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">    
   <div >
      <ul class="navbar-nav" >
   <!--      <li class="nav-item">
          <a class="nav-link itemnav" href="#">Localidades<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item itemnav">
          <a class="nav-link" href="#">HotSale</a>
        </li>-->
        @if (Session('nombreUsuario') == 'Andrea')
          <li class="nav-item itemnav">
            <a class="nav-link" href="/listarhospedajes">Ver Hospedajes</a>
          </li>
          <li class="nav-item itemnav">
            <a class="nav-link" href="/crearhospedaje">Crear Hospedajes</a>
          </li>
        @endif
      </ul>
    </div>
      <div class="row" style="margin-right: 15px; float:right" >
        <div class="btn-group" style="margin-right: 50px">
          <!-- Default dropleft button -->
          <div class="btn-group dropleft">
            <button type="button" style="margin-right: 20px" class="btn btn-lg btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-bell"></span>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#"><span class="  glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 1(Despues sacar esto)</a>
              <a class="dropdown-item" href="#"><span class=" glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 2</a>
              <a class="dropdown-item" href="#"><span class="  glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 3</a>
              <a class="dropdown-item" href="#"><span class=" glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Notificacion 4</a>
            </div>
          </div>

        <div class="btn-group" >
          <button class="btn btn-primary btn-lg" type="button">
            {{ session('nombreUsuario') }}
            {{ session('apellidoUsuario') }}
          </button>
          <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
  </div>
  @endif
</nav>
<div>
</div>