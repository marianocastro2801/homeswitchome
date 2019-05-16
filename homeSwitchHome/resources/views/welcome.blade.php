@extends('layouts.baseapp')
	<div>
        @if(session('exito'))
            <div class="alert alert-success">
                {{ session('exito') }}
            </div>
        @endif
    </div>
@section('content')
@endsection