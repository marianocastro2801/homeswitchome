@extends('layouts.baseapp')
@section('content')
<style type="text/css">
	

	.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

	small {
		display: block;
		line-height: 1.428571429;
		color: #999;
	}
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            Bhaumik Patel</h4>
                        <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>email@example.com
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <a href="/modificarcuenta" class="btn btn-primary">
                                Editar Perfil</a>
  
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc.mensajeExito')
@endsection