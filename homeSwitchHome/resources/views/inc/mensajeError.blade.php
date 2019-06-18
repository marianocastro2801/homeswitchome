@if ($errors->any())
		<div class="alert alert-danger" style="border-radius: 25px">
		    <ul>
		    	<button class="close" data-dismiss="alert"><span>&times;</span></button>
		        @foreach ($errors->all() as $error)
		           	<div class="text-center" >- {{ $error }}.</div>
			    @endforeach
			</ul>
		</div>
@endif