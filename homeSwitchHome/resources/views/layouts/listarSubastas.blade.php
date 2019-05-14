<?php 
use Illuminate\Support\Facades\DB;

?>

<ul>
@foreach($subastas as $subasta)
	<li>Monto base de la subasta: ${{ $subasta->monto_base }}</li>
	<li>Fecha inicio hospedaje: ${{ $subasta->fecha_inicio }}</li>
	<li>Fecha fin hospedaje: ${{ $subasta->fecha_fin }}</li>
	<li>Titulo hospedaje: <?php 
				$tituloHospedaje = DB::table('hospedajes')
					->select('titulo')
                    ->where('id', $subasta->id_hospedaje)
                    ->first();
                echo $tituloHospedaje->titulo;    
   	?>
    </li><br>
@endforeach	
</ul>