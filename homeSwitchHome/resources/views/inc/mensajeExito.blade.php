@if(session('exito'))
	  <div class="alert alert-success" style="border-radius: 25px">
	      <button class="close" data-dismiss="alert"><span>&times;</span></button>
	      <div class="text-center" style="border-radius: 25px">{{ session('exito') }}</div>
	  </div>
@endif