<?php
//dd($codigo[0]->colum_1);
//dd($estructuraCategoria->tipos_archivos[$i]->nombre);

?>
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
			<div class="col-md-12"><h1 class="titulo">{{ $codigo[0]->nombre  }}</h1></div>
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
		
			@for ($i = 0; $i <count($estructuraCategoria->tipos_archivos) ; $i++)

				@php 
					$name_lenguach = $estructuraCategoria->tipos_archivos[$i]->extension_archivo; 
					$contador = $i+1;
					$name_column = 'colum_'.$contador;
				@endphp	

				@if ($codigo[0]->$name_column !="")
					<!--html-->
					<div class="col-md-12 col-xs-12">
						<h1 class="titulo grande">{{ $estructuraCategoria->tipos_archivos[$i]->nombre }}</h1>
						<br>

						@if ($name_lenguach =='jquery')
							  <?php $name_lenguach='javascript'; ?>
						@endif

						<pre class="language-{{ $name_lenguach }} line-numbers contenido-codigo"><code>{{ $codigo[0]->$name_column }}</code>
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