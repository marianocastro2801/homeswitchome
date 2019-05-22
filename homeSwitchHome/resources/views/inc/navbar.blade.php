<style type="text/css">
  .itemnav{
    margin-left: 15px;
    margin-right: 15px;
  }
</style>

<nav class="navbar navbar-expand-sm container-fluid navbar-static-top navbar-dark bg-dark" >
  <a class="navbar-brand" href="/"><img src="/images/Logo.png" width="35" height="25" class="d-inline-block align-top">
   homeSwitchHome</a>
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
      <div style="float:right">
        <div class="btn-group">
          <button type="button" class="btn btn-info dropdown-toggle btn-lg"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                {{ session('nombreUsuario') }}
                {{ session('apellidoUsuario') }}
          </button>
          <div class="dropdown-menu" >
            <a class="dropdown-item" href="#"><span class="glyphicon glyphicon-user" style="margin-right: 10px"></span>Mi Perfil</a>
            <a class="dropdown-item" href="#"><span class="glyphicon glyphicon-info-sign" style="margin-right: 10px"></span>Contactos</a>
            <a class="dropdown-item" href="#"><span class="glyphicon glyphicon-question-sign" style="margin-right: 10px"></span>FAQ</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/sesion"><span class="glyphicon glyphicon-off" style="margin-right: 10px"></span>Cerrar sesion</a>
          </div>
      </div>
      </div>
  </div>
  @endif
</nav>
<div>
</div>