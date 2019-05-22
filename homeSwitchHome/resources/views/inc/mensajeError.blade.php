@if ($errors->any())
		<div class="alert alert-danger">
		    <ul>
		    	<button class="close" data-dismiss="alert"><span>&times;</span></button>
		        @foreach ($errors->all() as $error)
		           	<div>{{ $error }}</div>
			    @endforeach
			</ul>
		</div>
@endif