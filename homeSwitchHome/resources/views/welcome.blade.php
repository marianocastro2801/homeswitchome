@extends('layouts.baseapp')
@section('content')
	<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
    </div>
@endsection