@extends('indexMaster')

@section('title')
Recordatorio
@stop


@section('nuevoCss')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/css/font-awesome/css/font-awesome.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{  URL::asset('plugins/css/prism/prism.css')}}">
@stop


@section('contenidoAbajoizquierda')
	iiiiii
@stop

@section('contenidoAbajoderecha')
	<div class="container-fluid margin-bottom-20px">
		<div class="row">
			<div class="col-md-12"><h1 class="titulo">{{ $codigo[0]->nombre }}</h1></div>
		</div>
		<div class="row">
			<div class="col-md-12"><br><br></div>
		</div>

		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h2>Descripcion</h2>
				<p>
					{{ $codigo[0]->descripsion }}
				</p>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row ">
			<div class="col-md-12 margin-top-40px">
				
			</div>
		</div>

		
		<!--Codigos-->
		<div class="row codigos">
		
			@for ($i = 0; $i <count($datos[1]) ; $i++)

			

				
				@if ($codigo[0]->$datos[1][$i] !="")
					<!--html-->
					<div class="col-md-12 col-xs-12">
						<h1 class="titulo grande">{{ $datos[1][$i] }}</h1>
						<br>
						
						<!--Si la variable es jquery  pasa a ser javascript por que el editor solo reconoce javascript-->
						@if ($datos[1][$i] =='jquery')
							  <?php $tipo='javascript'; ?>

						@endif
						<!--Aqui language no acepta lenguage-jquery solo lenguage-javascript por eso el cambio de variable  -->
						<pre class="language-<?php if(isset($tipo)){ echo $tipo;}else{ echo $datos[1][$i]; } ?> line-numbers contenido-codigo"><code>{{ $codigo[0]->$datos[1][$i] }}</code>
						</pre>
					</div>
				@endif
				
			

			@endfor
			

		</div>
		<!--/codigos-->
		
		
		

	</div><!--/container fluid-->
@stop


@section('nuevojs')

<script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});

</script>

<script type="text/javascript" src="{{ URL::asset('plugins/prism/prism.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/misjs/funciones.js') }}"></script>


@stop