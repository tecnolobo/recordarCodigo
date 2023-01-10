<?php
//dd($datos);
?>
@extends('indexMaster')

@section('title')
Proyectos Laravel
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
			
			<!--recorremos $datos Array que contene  las llaves modelos, vista controlador-->
			@for ($i = 0; $i <count($datos[1]); $i++)
				
				@php $name_lenguach = $datos[1][$i]; @endphp	

				@if ($codigo[0]->$name_lenguach !=='')
					
					<!--html-->
					<div class="col-md-12 col-xs-12">
						<h1 class="titulo grande">{{ $name_lenguach }}</h1>
						<br>

						<pre class="language-php line-numbers contenido-codigo"><code>{{ $codigo[0]->$name_lenguach }}</code>
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