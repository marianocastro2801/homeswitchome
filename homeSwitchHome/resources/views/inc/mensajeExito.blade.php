@if(session('exito'))
	<div class="col-md-12">
	  <div class="alert alert-success">
	      <button class="close" data-dismiss="alert"><span>&times;</span></button>
	      {{ session('exito') }}
	  </div>
	</div>
@endif