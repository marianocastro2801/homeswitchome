@if(session('exito'))
  <div class="alert alert-success">
      <button class="close" data-dismiss="alert"><span>&times;</span></button>
      {{ session('exito') }}
  </div>
@endif